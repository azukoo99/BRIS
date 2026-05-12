@extends('layouts.app')

@section('title', 'Laporan Keuangan - CV. Benih Rakyat')

@section('content')

{{-- ============================================ --}}
{{-- LAPORAN KEUANGAN HEADER                      --}}
{{-- ============================================ --}}
<section class="relative pt-32 pb-20 bg-surface overflow-hidden min-h-[40vh] flex items-center">
    {{-- Decorative Elements --}}
    <div class="absolute top-20 right-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-gold/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="fade-up inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider rounded-full mb-4">Dashboard Laporan</span>
                <h1 class="fade-up fade-up-delay-1 text-4xl sm:text-5xl font-bold text-dark mb-4">
                    Laporan <span class="text-gradient">Keuangan</span>
                </h1>
                <p class="fade-up fade-up-delay-2 text-gray-500 max-w-xl">
                    Data Laporan Keuangan (Pemasukan & Pengeluaran) CV. Benih Rakyat.
                </p>
            </div>
            
            <div class="fade-up fade-up-delay-3 flex flex-wrap gap-3">
                <button class="inline-flex items-center gap-2 px-5 py-3 bg-white text-gray-700 text-sm font-semibold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    Filter
                </button>
                <button class="inline-flex items-center gap-2 px-5 py-3 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-light transition-all duration-200 shadow-lg shadow-primary/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh (PDF)
                </button>
                @if($role === 'admin')
                <button onclick="openModal('modal-transaksi')" class="inline-flex items-center gap-2 px-5 py-3 bg-secondary-light text-white text-sm font-semibold rounded-xl hover:bg-secondary transition-all duration-200 shadow-lg shadow-secondary/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Laporan
                </button>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- STATS OVERVIEW                               --}}
{{-- ============================================ --}}
<section class="py-12 bg-white relative z-10 -mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Stat Card 1 --}}
            <div class="fade-up bg-white rounded-2xl p-6 shadow-xl shadow-gray-200/40 border border-gray-100 flex flex-col relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-bl-full transition-transform duration-500 group-hover:scale-110"></div>
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-4 text-primary relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1 relative z-10">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-dark relative z-10">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
            </div>

            {{-- Stat Card 2 --}}
            <div class="fade-up fade-up-delay-1 bg-white rounded-2xl p-6 shadow-xl shadow-gray-200/40 border border-gray-100 flex flex-col relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-bl-full transition-transform duration-500 group-hover:scale-110"></div>
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center mb-4 text-red-500 relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1 relative z-10">Total Pengeluaran</p>
                <h3 class="text-2xl font-bold text-dark relative z-10">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- DETAIL TRANSAKSI TABLE                       --}}
{{-- ============================================ --}}
<section class="py-12 bg-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 fade-up">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="fade-up bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-lg font-bold text-dark">Rincian Laporan Keuangan</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis Laporan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Nominal</th>
                            @if($role === 'admin')
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($laporans as $t)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-dark">{{ $t->deskripsi ?: '-' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 {{ $t->jenis_laporan == 'pemasukan' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }} text-xs font-medium rounded-md capitalize">
                                    {{ $t->jenis_laporan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $t->jenis_laporan == 'pemasukan' ? 'text-green-600' : 'text-dark' }} text-right">
                                {{ $t->jenis_laporan == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($t->harga, 0, ',', '.') }}
                            </td>
                            @if($role === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="confirmHapus({{ $t->id }})" class="p-1.5 text-gray-400 hover:text-red-500 bg-gray-50 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">Belum ada data laporan keuangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-6 border-t border-gray-100">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</section>

@if($role === 'admin')
{{-- ============================================ --}}
{{-- MODALS (HANYA ADMIN)                         --}}
{{-- ============================================ --}}

{{-- Modal Overlay --}}
<div id="modal-overlay" class="fixed inset-0 bg-black/50 z-50 hidden backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeAllModals()"></div>

{{-- Modal Form Transaksi --}}
<div id="modal-transaksi" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 w-[90%] max-w-lg bg-white rounded-2xl shadow-2xl hidden opacity-0 scale-95 transition-all duration-300">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-xl font-bold text-dark">Form Data Laporan</h3>
        <button onclick="closeAllModals()" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <form action="{{ route('admin.laporan.store') }}" method="POST">
        @csrf
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Laporan</label>
                <select name="jenis_laporan" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <input type="text" name="deskripsi" placeholder="Contoh: Penjualan Benih Padi" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                <input type="number" name="harga" required min="0" placeholder="0" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
        </div>
        <div class="p-6 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50 rounded-b-2xl">
            <button type="button" onclick="closeAllModals()" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Batal</button>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20">Simpan Laporan</button>
        </div>
    </form>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="modal-hapus" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 w-[90%] max-w-sm bg-white rounded-2xl shadow-2xl hidden opacity-0 scale-95 transition-all duration-300 text-center">
    <div class="p-6">
        <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <h3 class="text-xl font-bold text-dark mb-2">Hapus Laporan?</h3>
        <p class="text-sm text-gray-500 mb-6">Data yang telah dihapus tidak dapat dikembalikan. Apakah Anda yakin ingin melanjutkan?</p>
        <div class="flex items-center justify-center gap-3">
            <button onclick="closeAllModals()" class="px-5 py-2.5 w-1/2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 transition-all">Batal</button>
            <form id="form-delete" action="" method="POST" class="w-1/2">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-5 py-2.5 bg-red-500 text-white text-sm font-semibold rounded-xl hover:bg-red-600 transition-all shadow-lg shadow-red-500/20">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Simple Modal Handler logic untuk frontend mockups
    function openModal(id) {
        const modal = document.getElementById(id);
        const overlay = document.getElementById('modal-overlay');
        
        overlay.classList.remove('hidden');
        modal.classList.remove('hidden');
        
        // Timeout to allow display block to render before opacity transition
        setTimeout(() => {
            overlay.classList.remove('opacity-0');
            modal.classList.remove('opacity-0', 'scale-95');
            modal.classList.add('opacity-100', 'scale-100');
        }, 10);
    }

    function confirmHapus(id) {
        openModal('modal-hapus');
        document.getElementById('form-delete').action = '/admin/laporan/' + id;
    }

    function closeAllModals() {
        const modals = document.querySelectorAll('[id^="modal-"]');
        const overlay = document.getElementById('modal-overlay');
        
        overlay.classList.add('opacity-0');
        modals.forEach(modal => {
            if (modal.id !== 'modal-overlay') {
                modal.classList.remove('opacity-100', 'scale-100');
                modal.classList.add('opacity-0', 'scale-95');
            }
        });
        
        // Wait for transition before hiding
        setTimeout(() => {
            overlay.classList.add('hidden');
            modals.forEach(modal => modal.classList.add('hidden'));
        }, 300);
    }
</script>
@endif

@endsection
