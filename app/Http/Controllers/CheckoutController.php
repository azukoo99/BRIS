<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\ItemPesanan;
use App\Models\Produk;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'shipping' => 'required|array',
            'shipping.address' => 'required|string',
        ]);

        $items = $request->items;
        $totalHarga = 0;

        foreach ($items as $item) {
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
        }

        return response()->json([
            'success' => true,
            'redirect_url' => route('payment.show', $pesanan->id)
        ]);
    }

    public function payment($id)
    {
        $pesanan = Pesanan::with('items.produk')->where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        return view('pesanan.payment', compact('pesanan'));
    }
}
