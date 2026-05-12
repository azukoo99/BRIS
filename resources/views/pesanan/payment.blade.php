@extends('layouts.app')

@section('title', 'Pembayaran - CV. Benih Rakyat')

@section('content')
<section class="pt-32 pb-20 bg-surface min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-up">
        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden p-8 sm:p-12">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            
            <h1 class="text-2xl sm:text-3xl font-bold text-dark mb-2">Checkout Berhasil!</h1>
            <p class="text-gray-500 mb-8">No. Pesanan Anda: <span class="font-bold text-primary">#BNR-{{ str_pad($pesanan->id, 6, '0', STR_PAD_LEFT) }}</span></p>

            <div class="bg-gray-50 rounded-2xl p-6 mb-8 text-left border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Total yang harus dibayar:</p>
                <p class="text-3xl font-bold text-primary mb-6">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                
                <hr class="border-gray-200 mb-4">
                
                <h3 class="text-sm font-semibold text-dark mb-2">Item yang Dipesan:</h3>
                <ul class="space-y-2 mb-6">
                    @foreach($pesanan->items as $item)
                        <li class="flex justify-between text-sm">
                            <span class="text-gray-600">{{ $item->produk ? $item->produk->nama : 'Produk' }} (x{{ $item->jumlah }})</span>
                            <span class="font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-blue-50 text-blue-800 p-4 rounded-xl text-sm mb-8 flex gap-3 text-left">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p>Silakan segera lakukan pembayaran sesuai dengan tagihan agar pesanan dapat segera diproses.</p>
            </div>

            <div class="flex flex-col gap-4 justify-center">
                <button onclick="showSuccessModal(event)" class="px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary-light transition-colors shadow-lg shadow-primary/20">
                    Cek Status Pembayaran
                </button>
            </div>
        </div>

    </div>
</section>

{{-- Success Modal --}}
<div id="success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
    <div class="relative bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl scale-95 opacity-0 transition-all duration-300" id="modal-content">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-dark mb-2">Pembayaran Berhasil!</h3>
        <p class="text-sm text-gray-500 mb-6">Terima kasih, pembayaran Anda telah dikonfirmasi. Pesanan Anda akan segera diproses.</p>
        <a href="{{ route('history.index') }}" class="block w-full py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary-light transition-colors shadow-lg shadow-primary/20">
            Lihat Riwayat Pesanan
        </a>
    </div>
</div>

<script>
function showSuccessModal(e) {
    e.preventDefault();
    const modal = document.getElementById('success-modal');
    const content = document.getElementById('modal-content');
    const btn = e.currentTarget;
    const originalText = btn.innerHTML;
    
    // Loading effect
    btn.innerHTML = `<svg class="animate-spin inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                     </svg> Mengecek...`;
    btn.disabled = true;
    
    // Simulate delay for checking payment status
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        
        // Show modal
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }, 1200);
}
</script>
@endsection
