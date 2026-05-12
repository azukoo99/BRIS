<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        // Hanya admin dan investor yang bisa melihat, tapi middleware auth sudah handle sebagian.
        // Role akan dipakai di view untuk menampilkan/menyembunyikan aksi.
        $laporans = LaporanKeuangan::orderBy('tanggal', 'desc')->paginate(10);

        $totalPendapatan = LaporanKeuangan::where('jenis_laporan', 'pemasukan')->sum('harga');
        $totalPengeluaran = LaporanKeuangan::where('jenis_laporan', 'pengeluaran')->sum('harga');

        return view('laporan.index', compact('laporans', 'role', 'totalPendapatan', 'totalPengeluaran'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'jenis_laporan' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        LaporanKeuangan::create([
            'jenis_laporan' => $request->jenis_laporan,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $laporan = LaporanKeuangan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
