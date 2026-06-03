<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\LaporanKeuangan;

class KasirController extends Controller
{
    public function index()
    {
        // Get all active products for the POS UI
        $produks = Produk::where('is_active', 'yes')->get();
        return view('admin.kasir.index', compact('produks'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:produk,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric'
        ]);

        $items = $request->items;
        $totalHarga = 0;

        // Validasi stok produk
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

        // Buat pesanan untuk offline
        $pesanan = Pesanan::create([
            'id_user' => Auth::id(), // Gunakan ID admin sebagai pencatat
            'status' => 'selesai',    // Langsung selesai karena dibayar di kasir
            'total_harga' => $totalHarga,
            'alamat_pengiriman' => 'Pembelian Offline (Kasir)', // Penanda bahwa ini pesanan offline
        ]);

        // Catat item dan kurangi stok
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

        // Catat ke Laporan Keuangan
        LaporanKeuangan::create([
            'jenis_laporan' => 'pemasukan',
            'tanggal' => now()->toDateString(),
            'deskripsi' => 'Penjualan Offline (Kasir) - Pesanan #BNR-' . str_pad($pesanan->id, 6, '0', STR_PAD_LEFT),
            'harga' => $totalHarga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dicatat.'
        ]);
    }
}
