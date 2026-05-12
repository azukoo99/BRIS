@extends('layouts.app')

@section('title', 'Kelola Pesanan - Admin Panel')

@section('content')
<section class="pt-32 pb-20 bg-surface min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 fade-up">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Daftar Pesanan</h1>
                <p class="text-gray-500 text-sm">Kelola semua pesanan pelanggan yang masuk dan perbarui status pengirimannya.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 fade-up">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($pesanans as $pesanan)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden fade-up">
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row gap-8">
                            
                            {{-- Info Pembeli & Pengiriman --}}
                            <div class="md:w-1/3 space-y-6">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Informasi Pembeli</h3>
                                    <p class="text-sm font-semibold text-dark">{{ $pesanan->user ? $pesanan->user->nama : 'User Dihapus' }}</p>
                                    <p class="text-sm text-gray-500">{{ $pesanan->user ? $pesanan->user->no_telp : '-' }}</p>
                                    <p class="text-sm text-gray-500">{{ $pesanan->user ? $pesanan->user->email : '-' }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Pengiriman</h3>
                                    <p class="text-sm text-gray-700 leading-relaxed">{{ $pesanan->alamat_pengiriman }}</p>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Waktu Pemesanan</h3>
                                    <p class="text-sm text-gray-700">{{ $pesanan->tanggal_pesanan->translatedFormat('d F Y, H:i') }} WIB</p>
                                </div>
                            </div>

                            {{-- Divider --}}
                            <div class="hidden md:block w-px bg-gray-100"></div>
                            <div class="md:hidden h-px bg-gray-100 w-full"></div>

                            {{-- Daftar Item & Update Status --}}
                            <div class="md:w-2/3 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Item Pesanan</h3>
                                    <div class="space-y-3 mb-6">
                                        @foreach($pesanan->items as $item)
                                            <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden shrink-0 border border-gray-100">
                                                        @if($item->produk && $item->produk->gambar)
                                                            <img src="{{ asset($item->produk->gambar) }}" class="w-full h-full object-cover">
                                                        @else
                                                            <div class="w-full h-full bg-gray-200"></div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-dark">{{ $item->produk ? $item->produk->nama : 'Produk Dihapus' }}</p>
                                                        <p class="text-xs text-gray-500">{{ $item->jumlah }} x Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                                <p class="text-sm font-bold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-between items-center mb-8">
                                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                                        <p class="text-lg font-bold text-primary">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                {{-- Aksi Status --}}
                                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-gray-600">Status Saat Ini:</span>
                                        @if($pesanan->status === 'diproses')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">Diproses</span>
                                        @elseif($pesanan->status === 'dikirim')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">Dikirim</span>
                                        @elseif($pesanan->status === 'dibatalkan')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Dibatalkan</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Selesai</span>
                                        @endif
                                    </div>
                                    
                                    <form action="{{ url('/admin/pesanan/' . $pesanan->id . '/status') }}" method="POST" class="flex items-center gap-2 w-full sm:w-auto">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="text-sm bg-white border border-gray-200 text-gray-700 rounded-xl px-3 py-2 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all flex-1 sm:flex-none">
                                            <option value="diproses" {{ $pesanan->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="dikirim" {{ $pesanan->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ $pesanan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="px-4 py-2 bg-dark text-white text-sm font-medium rounded-xl hover:bg-gray-800 transition-colors shrink-0">
                                            Update
                                        </button>
                                    </form>

                                    @if($pesanan->status === 'dibatalkan' || $pesanan->status === 'selesai')
                                        <div class="shrink-0">
                                            <button type="button" disabled class="p-2.5 bg-gray-50 border border-gray-200 text-gray-400 rounded-xl cursor-not-allowed" title="Tidak dapat dibatalkan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    @else
                                        <button type="button" onclick="confirmBatal({{ $pesanan->id }})" class="shrink-0 p-2.5 bg-white border border-red-200 text-red-500 rounded-xl hover:bg-red-50 hover:text-red-600 transition-colors" title="Batalkan Pesanan">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 text-center fade-up">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-dark mb-2">Belum Ada Pesanan Masuk</h3>
                    <p class="text-gray-500 text-sm">Pesanan dari pelanggan akan muncul di sini.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

{{-- Modal Konfirmasi Batal --}}
<div id="modal-overlay" class="fixed inset-0 bg-black/50 z-50 hidden backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeBatalModal()"></div>
<div id="modal-batal" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 w-[90%] max-w-sm bg-white rounded-2xl shadow-2xl hidden opacity-0 scale-95 transition-all duration-300 text-center">
    <div class="p-6">
        <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h3 class="text-xl font-bold text-dark mb-2">Batalkan Pesanan?</h3>
        <p class="text-sm text-gray-500 mb-6">Status pesanan ini akan diubah menjadi dibatalkan. Lanjutkan?</p>
        <div class="flex items-center justify-center gap-3">
            <button onclick="closeBatalModal()" class="px-5 py-2.5 w-1/2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 transition-all">Batal</button>
            <form id="form-batal" action="" method="POST" class="w-1/2">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="dibatalkan">
                <button type="submit" class="w-full px-5 py-2.5 bg-red-500 text-white text-sm font-semibold rounded-xl hover:bg-red-600 transition-all shadow-lg shadow-red-500/20">Ya, Batalkan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmBatal(id) {
        const modal = document.getElementById('modal-batal');
        const overlay = document.getElementById('modal-overlay');
        const formBatal = document.getElementById('form-batal');
        
        formBatal.action = '/admin/pesanan/' + id + '/status';
        
        overlay.classList.remove('hidden');
        modal.classList.remove('hidden');
        
        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            modal.classList.remove('opacity-0', 'scale-95');
            modal.classList.add('opacity-100', 'scale-100');
        }, 10);
    }

    function closeBatalModal() {
        const modal = document.getElementById('modal-batal');
        const overlay = document.getElementById('modal-overlay');
        
        overlay.classList.add('opacity-0');
        modal.classList.remove('opacity-100', 'scale-100');
        modal.classList.add('opacity-0', 'scale-95');
        
        setTimeout(() => {
            overlay.classList.add('hidden');
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
