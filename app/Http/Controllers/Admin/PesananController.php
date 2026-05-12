<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        // Load the user who ordered, and the items inside the order
        $pesanans = Pesanan::with(['user', 'items.produk'])
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
