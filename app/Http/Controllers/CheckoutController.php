<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\Produk;
use App\Models\LaporanKeuangan;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'shipping' => 'required|array',
            'shipping.name' => 'required|string',
            'shipping.phone' => 'required|string',
            'shipping.email' => 'required|email',
            'shipping.address' => 'required|string',
            'shipping.city' => 'required|string',
        ]);

        $items = $request->items;
        $totalHarga = 0;

        foreach ($items as $item) {
            $produk = Produk::find($item['id']);
            if (!$produk || $produk->stok < $item['qty']) {
                $namaProduk = $produk ? $produk->nama : 'Produk';
                return response()->json([
                    'success' => false,
                    'message' => "Stok $namaProduk tidak mencukupi."
                ], 400);
            }
            $totalHarga += ($item['price'] * $item['qty']);
        }

        // Create Order
        $pesanan = Pesanan::create([
            'id_user' => Auth::id(),
            'status' => 'diproses',
            'total_harga' => $totalHarga,
            'alamat_pengiriman' => $request->shipping['address'] . ', ' . $request->shipping['city'],
        ]);

        // Create Order Items
        foreach ($items as $item) {
            ItemPesanan::create([
                'id_pesanan' => $pesanan->id,
                'id_produk' => $item['id'],
                'jumlah' => $item['qty'],
                'harga_produk' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);

            // Deduct stock
            $produk = Produk::find($item['id']);
            if ($produk) {
                $produk->decrement('stok', $item['qty']);
            }
        }

        // Load items for Midtrans transaction parameters
        $pesanan->load('items.produk');

        // Set Midtrans Configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Build transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => 'BNR-' . $pesanan->id,
                'gross_amount' => (int)$pesanan->total_harga,
            ],
            'customer_details' => [
                'first_name' => $request->shipping['name'],
                'email' => $request->shipping['email'],
                'phone' => $request->shipping['phone'],
            ],
            'item_details' => $pesanan->items->map(function ($item) {
                return [
                    'id' => $item->id_produk,
                    'price' => (int)$item->harga_produk,
                    'quantity' => (int)$item->jumlah,
                    'name' => $item->produk ? substr($item->produk->nama, 0, 50) : 'Produk',
                ];
            })->toArray(),
        ];

        try {
            // Get Snap Payment Page Token
            $snapToken = Snap::getSnapToken($params);
            $pesanan->snap_token = $snapToken;
            $pesanan->save();
        } catch (\Exception $e) {
            Log::error("Midtrans Snap Token Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungkan ke Midtrans. Silakan coba kembali.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'order_id' => $pesanan->id
        ]);
    }

    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        if (!$notification) {
            return response()->json(['message' => 'Empty payload'], 400);
        }

        // Verify Signature Key
        $serverKey = config('midtrans.server_key');
        $signatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . $serverKey);

        if ($signatureKey !== $notification->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // order_id is in format BNR-{id}
        $orderId = str_replace('BNR-', '', $notification->order_id);
        $pesanan = Pesanan::find($orderId);

        if (!$pesanan) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $pesanan->status = 'diproses';
                } else {
                    $pesanan->status = 'selesai';
                }
            }
        } else if ($transactionStatus == 'settlement') {
            $pesanan->status = 'selesai';
        } else if ($transactionStatus == 'pending') {
            $pesanan->status = 'diproses';
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $pesanan->status = 'dibatalkan';
        }

        // If status changed to selesai, record inside LaporanKeuangan
        if ($pesanan->isDirty('status') && $pesanan->status === 'selesai') {
            $exists = LaporanKeuangan::where('id_pesanan', $pesanan->id)->exists();
            if (!$exists) {
                LaporanKeuangan::create([
                    'jenis_laporan' => 'pemasukan',
                    'tanggal' => now()->toDateString(),
                    'deskripsi' => 'Penjualan Online - Pesanan #BNR-' . str_pad($pesanan->id, 6, '0', STR_PAD_LEFT),
                    'harga' => $pesanan->total_harga,
                    'id_pesanan' => $pesanan->id,
                ]);
            }
        }

        $pesanan->save();

        return response()->json(['message' => 'Notification handled successfully']);
    }
}
