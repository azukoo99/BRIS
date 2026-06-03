@extends('layouts.app')

@section('title', 'Checkout - CV. Benih Rakyat')

@push('styles')
<style>
    .step-line { transition: width 0.5s ease; }

    .payment-option {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .payment-option.selected {
        border-color: #1B4332;
        background-color: #F8FAF5;
    }
    .payment-option.selected .pay-radio {
        background-color: #1B4332;
        border-color: #1B4332;
    }
    .payment-option.selected .pay-radio::after {
        content: '';
        display: block;
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
        margin: auto;
        margin-top: 3px;
    }

    .pay-radio {
        width: 18px; height: 18px;
        border: 2px solid #D1D5DB;
        border-radius: 50%;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }

    #btn-pay {
        transition: all 0.3s ease;
    }
    #btn-pay:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .order-item { transition: all 0.2s ease; }
</style>
@endpush

@section('content')

{{-- ============================================ --}}
{{-- PAGE HEADER                                  --}}
{{-- ============================================ --}}
<section class="bg-surface border-b border-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-4">
            <a href="/" class="hover:text-primary transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="/produk?role={{ $role }}" class="hover:text-primary transition-colors">Produk</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-primary font-medium">Checkout</span>
        </nav>

        {{-- Steps --}}
        <div class="flex items-center gap-0 max-w-md">
            {{-- Step 1 --}}
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-primary flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-primary hidden sm:inline">Keranjang</span>
            </div>
            <div class="flex-1 h-0.5 bg-primary mx-2 max-w-12"></div>

            {{-- Step 2 --}}
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">2</div>
                <span class="text-xs font-semibold text-primary hidden sm:inline">Checkout</span>
            </div>
            <div class="flex-1 h-0.5 bg-gray-200 mx-2 max-w-12"></div>

            {{-- Step 3 --}}
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-xs font-bold">3</div>
                <span class="text-xs font-medium text-gray-400 hidden sm:inline">Pembayaran</span>
            </div>
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- EMPTY CART REDIRECT                          --}}
{{-- ============================================ --}}
<div id="empty-checkout" class="hidden py-24 text-center">
    <div class="max-w-sm mx-auto px-4">
        <div class="w-20 h-20 bg-surface rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-dark mb-2">Keranjang Kosong</h3>
        <p class="text-sm text-gray-400 mb-6">Tambahkan produk terlebih dahulu sebelum checkout.</p>
        <a href="/produk?role={{ $role }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary-light transition-all duration-200">
            Kembali ke Katalog
        </a>
    </div>
</div>


{{-- ============================================ --}}
{{-- CHECKOUT LAYOUT                              --}}
{{-- ============================================ --}}
<div id="checkout-content" class="hidden">
<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-5 gap-8 items-start">

            {{-- LEFT: Forms (3/5) --}}
            <div class="lg:col-span-3 space-y-6">

                {{-- ---- Shipping Info ---- --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="font-bold text-dark">Informasi Pengiriman</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Lengkap <span class="text-accent">*</span></label>
                                <input type="text" id="shipping-name" placeholder="Masukkan nama lengkap"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">No. WhatsApp / Telepon <span class="text-accent">*</span></label>
                                <input type="tel" id="shipping-phone" placeholder="08xxxxxxxxxx"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email <span class="text-accent">*</span></label>
                            <input type="email" id="shipping-email" placeholder="email@example.com"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Alamat Lengkap <span class="text-accent">*</span></label>
                            <textarea id="shipping-address" rows="3" placeholder="Jl. Nama Jalan No. XX, RT/RW, Kelurahan, Kecamatan..."
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none"></textarea>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kota / Kabupaten <span class="text-accent">*</span></label>
                                <input type="text" id="shipping-city" placeholder="Contoh: Jember"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Kode Pos</label>
                                <input type="text" id="shipping-postal" placeholder="67xxx"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Catatan Pesanan (opsional)</label>
                            <textarea id="order-note" rows="2" placeholder="Misal: harap dikemas dengan baik, atau instruksi khusus lainnya..."
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all resize-none"></textarea>
                        </div>
                    </div>
                </div>

                {{-- ---- Shipping Method ---- --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"/>
                            </svg>
                        </div>
                        <h2 class="font-bold text-dark">Metode Pengiriman</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <label class="payment-option selected flex items-center gap-4 p-4 border-2 border-primary rounded-xl" id="ship-reguler">
                            <input type="radio" name="shipping" value="reguler" checked class="hidden">
                            <div class="pay-radio bg-primary border-primary flex items-center justify-center">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-dark">Pengiriman Reguler</p>
                                <p class="text-xs text-gray-400">Estimasi 3–5 hari kerja</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-dark">Dihitung saat konfirmasi</p>
                                <p class="text-xs text-gray-400">Berdasarkan berat & lokasi</p>
                            </div>
                        </label>
                        <label class="payment-option flex items-center gap-4 p-4 border-2 border-gray-100 rounded-xl" id="ship-ekspres">
                            <input type="radio" name="shipping" value="ekspres" class="hidden">
                            <div class="pay-radio"></div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-dark">Pengiriman Ekspres</p>
                                <p class="text-xs text-gray-400">Estimasi 1–2 hari kerja</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-dark">Dihitung saat konfirmasi</p>
                                <p class="text-xs text-gray-400">Prioritas handling</p>
                            </div>
                        </label>
                        <label class="payment-option flex items-center gap-4 p-4 border-2 border-gray-100 rounded-xl" id="ship-ambil">
                            <input type="radio" name="shipping" value="pickup" class="hidden">
                            <div class="pay-radio"></div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-dark">Ambil Sendiri (Pickup)</p>
                                <p class="text-xs text-gray-400">Desa Bago, Pasirian, Lumajang</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-primary">Gratis</p>
                                <p class="text-xs text-gray-400">Konfirmasi dulu via WA</p>
                            </div>
                        </label>
                    </div>
                </div>



            </div>


            {{-- RIGHT: Order Summary (2/5) --}}
            <div class="lg:col-span-2 space-y-4 lg:sticky lg:top-24">

                {{-- Summary Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h2 class="font-bold text-dark">Ringkasan Pesanan</h2>
                    </div>

                    {{-- Items --}}
                    <div class="px-6 py-4" id="order-items">
                        {{-- Rendered by JS --}}
                    </div>

                    {{-- a href back --}}
                    <div class="px-6 pb-4">
                        <a href="/produk?role={{ $role }}"
                           class="flex items-center gap-1 text-xs text-primary hover:underline">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Edit Keranjang
                        </a>
                    </div>

                    {{-- Price Breakdown --}}
                    <div class="px-6 py-4 bg-surface border-t border-gray-100 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal produk</span>
                            <span class="font-semibold text-dark" id="summary-subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Ongkos kirim</span>
                            <span class="font-medium text-gray-400">Dihitung saat konfirmasi</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Biaya layanan Midtrans</span>
                            <span class="font-medium text-gray-400">Sesuai metode bayar</span>
                        </div>
                        <div class="pt-2 border-t border-gray-200 flex justify-between">
                            <span class="font-bold text-dark">Total (belum ongkir)</span>
                            <span class="font-bold text-primary text-lg" id="summary-total">Rp 0</span>
                        </div>
                    </div>
                </div>

                {{-- Guarantee Badge --}}
                <div class="bg-surface rounded-2xl border border-gray-100 p-4">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-dark mb-1">Jaminan Kualitas BPSB</p>
                            <p class="text-[11px] text-gray-500 leading-relaxed">Semua produk benih bersertifikasi resmi BPSB Indonesia. Garansi kualitas terjamin setiap kemasan.</p>
                        </div>
                    </div>
                </div>

                {{-- CTA Button --}}
                <button id="btn-pay"
                        onclick="submitOrder()"
                        class="w-full flex items-center justify-center gap-2 py-4 bg-primary text-white font-bold rounded-2xl
                               hover:bg-primary-light transition-all duration-200 hover:shadow-xl hover:shadow-primary/25 active:scale-95 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Lanjut ke Pembayaran
                </button>

                <p class="text-[11px] text-gray-400 text-center">
                    Dengan menekan tombol, kamu menyetujui
                    <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> kami
                </p>

            </div>
        </div>
    </div>
</section>
</div>


{{-- ============================================ --}}
{{-- SUCCESS MODAL (simulasi)                     --}}
{{-- ============================================ --}}
<div id="success-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
    <div class="relative bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-dark mb-2">Pesanan Diterima!</h3>
        <p class="text-sm text-gray-500 mb-2">No. Pesanan: <span id="order-number" class="font-bold text-primary">#BNR-000001</span></p>
        <p class="text-sm text-gray-500 mb-6">Tim kami akan menghubungi kamu via WhatsApp untuk konfirmasi pengiriman & pembayaran Midtrans.</p>
        <div class="flex gap-3">
            <a href="/produk?role={{ $role }}"
               class="flex-1 py-3 border border-gray-200 text-gray-600 font-semibold text-sm rounded-xl hover:bg-gray-50 transition-colors">
                Lanjut Belanja
            </a>
            <a href="https://wa.me/6282338979023" target="_blank"
               class="flex-1 py-3 bg-green-600 text-white font-semibold text-sm rounded-xl hover:bg-green-700 transition-colors flex items-center justify-center gap-1.5">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Konfirmasi WA
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
// ====================================================
// Checkout Page Script
// ====================================================
const CART_KEY = 'benihrakyat_cart';

function getCart() {
    return JSON.parse(localStorage.getItem(CART_KEY) || '[]');
}

function formatRupiah(num) {
    return 'Rp ' + num.toLocaleString('id-ID');
}

// ---- Init ----
function initCheckout() {
    const cart = getCart();

    if (cart.length === 0) {
        document.getElementById('empty-checkout').classList.remove('hidden');
        document.getElementById('checkout-content').classList.add('hidden');
        return;
    }

    document.getElementById('checkout-content').classList.remove('hidden');
    renderOrderSummary(cart);
}

function renderOrderSummary(cart) {
    const container = document.getElementById('order-items');
    const subtotal   = cart.reduce((s, i) => s + i.price * i.qty, 0);

    container.innerHTML = cart.map(item => `
        <div class="order-item flex gap-3 pb-3 mb-3 border-b border-gray-50 last:border-0 last:mb-0 last:pb-0">
            <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                <img src="/images/${item.image}" alt="${item.name}" class="w-full h-full object-cover"
                     onerror="this.parentElement.innerHTML='<div class=\\'flex items-center justify-center h-full text-gray-300 text-lg\\'>🌾</div>'">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-dark truncate">${item.name}</p>
                <p class="text-[11px] text-gray-400">${item.qty} kg × ${formatRupiah(item.price)}</p>
            </div>
            <p class="text-xs font-bold text-primary shrink-0">${formatRupiah(item.price * item.qty)}</p>
        </div>
    `).join('');

    document.getElementById('summary-subtotal').textContent = formatRupiah(subtotal);
    document.getElementById('summary-total').textContent = formatRupiah(subtotal);
}



// ---- Shipping option toggle ----
document.querySelectorAll('label[id^="ship-"]').forEach(label => {
    label.addEventListener('click', () => {
        document.querySelectorAll('label[id^="ship-"]').forEach(l => {
            l.classList.remove('selected', 'border-primary');
            l.classList.add('border-gray-100');
            const r = l.querySelector('.pay-radio');
            r.style.cssText = '';
            const dot = r.querySelector('div');
            if (dot) dot.remove();
        });

        label.classList.add('selected', 'border-primary');
        label.classList.remove('border-gray-100');
        const radio = label.querySelector('.pay-radio');
        radio.style.backgroundColor = '#1B4332';
        radio.style.borderColor = '#1B4332';
        if (!radio.querySelector('div')) {
            const dot = document.createElement('div');
            dot.className = 'w-2 h-2 bg-white rounded-full m-auto mt-1';
            radio.appendChild(dot);
        }
    });
});

// ---- Submit Order (Frontend Simulation) ----
function submitOrder() {
    const name    = document.getElementById('shipping-name').value.trim();
    const phone   = document.getElementById('shipping-phone').value.trim();
    const email   = document.getElementById('shipping-email').value.trim();
    const address = document.getElementById('shipping-address').value.trim();
    const city    = document.getElementById('shipping-city').value.trim();

    // Validate
    if (!name || !phone || !email || !address || !city) {
        // Highlight empty fields
        [
            { id: 'shipping-name',    val: name },
            { id: 'shipping-phone',   val: phone },
            { id: 'shipping-email',   val: email },
            { id: 'shipping-address', val: address },
            { id: 'shipping-city',    val: city },
        ].forEach(({ id, val }) => {
            const el = document.getElementById(id);
            if (!val) {
                el.classList.add('border-accent', 'ring-2', 'ring-accent/20');
                el.addEventListener('input', () => {
                    el.classList.remove('border-accent', 'ring-2', 'ring-accent/20');
                }, { once: true });
            }
        });

        // Scroll to first error
        document.getElementById('shipping-name').scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    const btn = document.getElementById('btn-pay');
    btn.disabled = true;
    btn.innerHTML = `
        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
        Memproses...
    `;

    const cart = getCart();
    
    // API call Checkout
    fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            items: cart,
            shipping: { name, phone, email, address, city },
        }),
    })
    .then(res => {
        if (!res.ok) {
            return res.json().then(err => { throw err; });
        }
        return res.json();
    })
    .then(data => {
        if(data.success && data.snap_token) {
            // Empty local storage cart
            localStorage.removeItem(CART_KEY);
            
            // Trigger Midtrans Snap Popup
            window.snap.pay(data.snap_token, {
                onSuccess: function(result){
                    window.location.href = '/history';
                },
                onPending: function(result){
                    window.location.href = '/history';
                },
                onError: function(result){
                    alert('Pembayaran gagal! Silakan coba lagi melalui halaman Riwayat Pesanan.');
                    window.location.href = '/history';
                },
                onClose: function(){
                    alert('Pembayaran tertunda. Kamu dapat menyelesaikannya nanti di halaman Riwayat Pesanan.');
                    window.location.href = '/history';
                }
            });
        } else {
            alert(data.message || 'Gagal memproses pesanan');
            btn.disabled = false;
            btn.innerHTML = 'Lanjut ke Pembayaran';
        }
    })
    .catch(err => {
        alert(err.message || 'Terjadi kesalahan koneksi');
        btn.disabled = false;
        btn.innerHTML = 'Lanjut ke Pembayaran';
    });
}

// ---- Init on load ----
initCheckout();
</script>
@endpush
