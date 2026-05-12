<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class HistoryController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['items.produk'])
            ->where('id_user', Auth::id())
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('pesanan.history', compact('pesanans'));
    }
}
