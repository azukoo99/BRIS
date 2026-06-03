<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\LaporanKeuangan;

class PesananController extends Controller
{
    public function index()
    {
        // Load the user who ordered, and the items inside the order
        $pesanans = Pesanan::with(['user', 'items.produk'])
            ->orderBy('tanggal_pesanan', 'desc')
            ->orderBy('id', 'desc')
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
        
        // Cek jika status diubah menjadi selesai dan pastikan belum pernah dicatat
        // Kita gunakan isDirty untuk memastikan status benar-benar baru berubah ke 'selesai'
        if ($pesanan->isDirty('status') && $request->status === 'selesai') {
            LaporanKeuangan::create([
                'jenis_laporan' => 'pemasukan',
                'tanggal' => now()->toDateString(),
                'deskripsi' => 'Penjualan Online - Pesanan #BNR-' . str_pad($pesanan->id, 6, '0', STR_PAD_LEFT),
                'harga' => $pesanan->total_harga,
            ]);
        }
        
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
