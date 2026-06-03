<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $role = Auth::user()->role;
        
        $query = LaporanKeuangan::query();
        $statsQuery = LaporanKeuangan::query();

        // Apply filters
        if ($request->filled('jenis_laporan') && in_array($request->jenis_laporan, ['pemasukan', 'pengeluaran'])) {
            $query->where('jenis_laporan', $request->jenis_laporan);
            $statsQuery->where('jenis_laporan', $request->jenis_laporan);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal', '>=', $request->tanggal_mulai);
            $statsQuery->where('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->where('tanggal', '<=', $request->tanggal_selesai);
            $statsQuery->where('tanggal', '<=', $request->tanggal_selesai);
        }

        $laporans = $query->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // Total Pendapatan & Pengeluaran mencerminkan filter jika diisi
        $totalPendapatan = (clone $statsQuery)->where('jenis_laporan', 'pemasukan')->sum('harga');
        $totalPengeluaran = (clone $statsQuery)->where('jenis_laporan', 'pengeluaran')->sum('harga');

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
