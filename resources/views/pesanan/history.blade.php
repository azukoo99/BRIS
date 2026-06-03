@extends('layouts.app')

@section('title', 'History Pesanan - CV. Benih Rakyat')

@section('content')
<section class="pt-32 pb-20 bg-surface min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center gap-4 fade-up">
            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-dark mb-1">History Pesanan</h1>
                <p class="text-gray-500 text-sm">Lacak status dan riwayat pembelian benih Anda di sini.</p>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($pesanans as $pesanan)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-lg overflow-hidden fade-up">
                    {{-- Header Pesanan --}}
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Tanggal Pembelian</p>
                                <p class="text-sm font-semibold text-dark">{{ $pesanan->tanggal_pesanan->translatedFormat('d M Y, H:i') }}</p>
                            </div>
                            <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Total Harga</p>
                                <p class="text-sm font-bold text-primary">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        {{-- Status Badge --}}
                        <div>
                            @if($pesanan->status === 'diproses')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-200/50">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                    Sedang Diproses
                                </span>
                            @elseif($pesanan->status === 'dikirim')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-200/50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                    Dalam Pengiriman
                                </span>
                            @elseif($pesanan->status === 'dibatalkan')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-600 border border-red-200/50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Dibatalkan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-600 border border-green-200/50">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Pesanan Selesai
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Body Pesanan (Items) --}}
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($pesanan->items as $item)
                                <div class="flex items-start sm:items-center gap-4">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 rounded-xl overflow-hidden shrink-0 border border-gray-100">
                                        @if($item->produk && $item->produk->gambar)
                                            <img src="{{ asset($item->produk->gambar) }}" alt="{{ $item->produk->nama }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm sm:text-base font-bold text-dark truncate">{{ $item->produk ? $item->produk->nama : 'Produk Tidak Ditemukan' }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $item->jumlah }} x Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-xs text-gray-400 mb-1">Subtotal</p>
                                        <p class="text-sm font-semibold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between gap-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-1">Alamat Pengiriman:</p>
                                <p class="text-sm text-gray-700 leading-relaxed">{{ $pesanan->alamat_pengiriman }}</p>
                            </div>
                            @if($pesanan->status === 'diproses')
                                <div class="shrink-0 flex items-end gap-2">
                                    @if($pesanan->snap_token)
                                        <button onclick="payNow('{{ $pesanan->snap_token }}')" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white font-semibold text-xs rounded-xl hover:bg-primary-light transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                            Bayar Sekarang
                                        </button>
                                    @endif
                                    <a href="https://wa.me/6281234567890?text={{ urlencode('Halo admin, saya ingin membatalkan pesanan dengan ID #BNR-'.str_pad($pesanan->id, 6, '0', STR_PAD_LEFT).' karena ...') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 border border-red-200 text-red-600 font-semibold text-xs rounded-xl hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Batalkan Pesanan (WA)
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 text-center fade-up">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-dark mb-2">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 text-sm mb-6">Anda belum pernah melakukan pemesanan benih.</p>
                    <a href="/produk" class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20">
                        Mulai Belanja
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</section>

@push('scripts')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    function payNow(snapToken) {
        window.snap.pay(snapToken, {
            onSuccess: function(result){
                window.location.reload();
            },
            onPending: function(result){
                window.location.reload();
            },
            onError: function(result){
                alert('Pembayaran gagal! Silakan coba beberapa saat lagi.');
            },
            onClose: function(){
                alert('Popup pembayaran ditutup sebelum transaksi diselesaikan.');
            }
        });
    }
</script>
@endpush
@endsection
