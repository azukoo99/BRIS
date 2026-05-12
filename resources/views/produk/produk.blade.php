@extends('layouts.app')

@section('title', 'Katalog Produk - CV. Benih Rakyat')

@push('styles')
<style>
    /* ---- Cart Drawer ---- */
    .cart-drawer {
        transform: translateX(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cart-drawer.open { transform: translateX(0); }

    .cart-backdrop {
        opacity: 0; pointer-events: none;
        transition: opacity 0.3s ease;
    }
    .cart-backdrop.open { opacity: 1; pointer-events: auto; }

    /* ---- Product Card ---- */
    .product-card {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 60px rgba(27, 67, 50, 0.12);
    }

    /* ---- Qty Button ---- */
    .qty-btn { transition: all 0.15s ease; }
    .qty-btn:hover { background-color: #1B4332; color: white; }

    /* ---- Filter Active ---- */
    .filter-btn.active {
        background-color: #1B4332;
        color: white;
        border-color: #1B4332;
    }

    /* ---- Cart Item ---- */
    .cart-item { transition: opacity 0.2s ease, transform 0.2s ease; }
    .cart-item.removing { opacity: 0; transform: translateX(20px); }

    /* ---- Floating Cart Badge ---- */
    #cart-badge {
        transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    #cart-badge.bump { transform: scale(1.4); }
</style>
@endpush

@section('content')

{{-- ============================================ --}}
{{-- PAGE HEADER                                  --}}
{{-- ============================================ --}}
<section class="bg-surface border-b border-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                    <a href="/" class="hover:text-primary transition-colors">Beranda</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-primary font-medium">Produk</span>
                </nav>
                <h1 class="text-2xl sm:text-3xl font-bold text-dark">Katalog Produk</h1>
                <p class="text-sm text-gray-500 mt-1">Benih unggul bersertifikasi BPSB untuk hasil panen optimal</p>
            </div>

            {{-- Cart Button --}}
            <button id="open-cart-btn"
                class="relative flex items-center gap-2 px-5 py-3 bg-primary text-white font-semibold text-sm rounded-xl
                       hover:bg-primary-light transition-all duration-200 hover:shadow-lg hover:shadow-primary/20 self-start sm:self-auto">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                Keranjang
                <span id="cart-badge"
                      class="absolute -top-2 -right-2 w-5 h-5 bg-accent text-white text-[10px] font-bold rounded-full flex items-center justify-center hidden">
                    0
                </span>
            </button>
        </div>

        {{-- Search Bar --}}
        <div class="mt-8 mb-2">
            <div class="relative max-w-md w-full">
                <input type="text" id="search-input" placeholder="Cari benih unggul..." class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all shadow-sm">
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- PRODUCT GRID                                 --}}
{{-- ============================================ --}}
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Guest Notice --}}
        @if ($role === 'guest')
        <div class="mb-8 flex items-center gap-3 p-4 bg-amber-50 border border-amber-200 rounded-2xl">
            <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-amber-700">
                Kamu perlu <a href="/login" class="font-semibold underline">login sebagai pelanggan</a> untuk memesan produk.
            </p>
        </div>
        @endif

        {{-- Products Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="products-grid">

            @php
            $formattedProducts = $produks->map(function($p) {
                $fallbackImage = asset('images/product-padi.png');
                return [
                    'id'          => $p->id,
                    'name'        => $p->nama,
                    'image'       => $p->gambar ? asset($p->gambar) : $fallbackImage,
                    'price'       => $p->harga,
                    'unit'        => 'kg',
                    'pack_size'   => 'Kemasan Standar',
                    'stock'       => $p->stok,
                    'badge'       => 'Tersedia',
                    'badge_color' => 'bg-primary',
                    'description' => $p->deskripsi,
                    'specs'       => [],
                ];
            });
            @endphp

            @forelse ($formattedProducts as $product)
            <div class="product-card bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">
                {{-- Image --}}
                <div class="relative overflow-hidden h-52 bg-gray-50">
                    <img src="{{ $product['image'] }}"
                         alt="{{ $product['name'] }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    {{-- Category Badge --}}
                    <div class="absolute top-3 left-3">
                        <span class="{{ $product['badge_color'] }} text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                            {{ $product['badge'] }}
                        </span>
                    </div>
                    {{-- BPSB Badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/90 backdrop-blur-sm text-primary text-[10px] font-semibold px-2 py-1 rounded-full border border-primary/20">
                            ✓ BPSB
                        </span>
                    </div>
                    {{-- Stock indicator --}}
                    @if ($product['stock'] < 200)
                    <div class="absolute bottom-3 right-3">
                        <span class="bg-accent/90 text-white text-[10px] font-semibold px-2 py-1 rounded-full">
                            Stok Terbatas
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-5">
                    {{-- Name --}}
                    <div class="mb-3">
                        <h3 class="product-title text-base font-bold text-dark mt-0.5">{{ $product['name'] }}</h3>
                    </div>

                    {{-- Description --}}
                    <p class="text-xs text-gray-500 leading-relaxed mb-3 line-clamp-2">{{ $product['description'] }}</p>

                    {{-- Specs --}}
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach ($product['specs'] as $spec)
                        <span class="text-[10px] bg-surface text-primary px-2 py-0.5 rounded-full border border-primary/10 font-medium">
                            {{ $spec }}
                        </span>
                        @endforeach
                    </div>

                    {{-- Price & Pack --}}
                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <p class="text-xl font-bold text-primary">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                                <span class="text-sm font-normal text-gray-400">/{{ $product['unit'] }}</span>
                            </p>
                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $product['pack_size'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[11px] text-gray-400">Stok</p>
                            <p class="text-sm font-semibold text-dark">{{ number_format($product['stock'], 0, ',', '.') }} kg</p>
                        </div>
                    </div>

                    {{-- Action --}}
                    @if ($role === 'pelanggan')
                        {{-- Qty Selector + Add to Cart --}}
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-1 border border-gray-200 rounded-xl overflow-hidden">
                                <button class="qty-btn w-8 h-10 flex items-center justify-center text-gray-600 border-r border-gray-200 text-lg font-medium"
                                        onclick="decreaseQty({{ $product['id'] }})">−</button>
                                <input type="number" id="qty-{{ $product['id'] }}" value="1" min="1" max="{{ $product['stock'] }}"
                                       class="w-10 h-10 text-center text-sm font-semibold text-dark border-0 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button class="qty-btn w-8 h-10 flex items-center justify-center text-gray-600 border-l border-gray-200 text-lg font-medium"
                                        onclick="increaseQty({{ $product['id'] }}, {{ $product['stock'] }})">+</button>
                            </div>
                            <button onclick="addToCart({{ json_encode($product) }})"
                                    class="flex-1 flex items-center justify-center gap-1.5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl
                                           hover:bg-primary-light transition-all duration-200 hover:shadow-lg hover:shadow-primary/20 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                </svg>
                                Tambah
                            </button>
                        </div>
                    @elseif ($role === 'guest')
                        <a href="/login"
                           class="flex items-center justify-center gap-1.5 w-full py-2.5 border-2 border-primary text-primary text-sm font-semibold rounded-xl
                                  hover:bg-primary hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login untuk Memesan
                        </a>
                    @else
                        <div class="flex items-center justify-center gap-1.5 w-full py-2.5 bg-gray-100 text-gray-400 text-sm font-medium rounded-xl cursor-not-allowed">
                            Tersedia untuk Pelanggan
                        </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                <p class="text-base font-medium">Belum ada produk yang tersedia.</p>
            </div>
            @endforelse

        </div>
    </div>
</section>


{{-- ============================================ --}}
{{-- CART DRAWER                                  --}}
{{-- ============================================ --}}

{{-- Backdrop --}}
<div id="cart-backdrop" class="cart-backdrop fixed inset-0 z-40 bg-black/40"></div>

{{-- Drawer --}}
<div id="cart-drawer" class="cart-drawer fixed top-0 right-0 bottom-0 z-50 w-full max-w-md bg-white shadow-2xl flex flex-col">

    {{-- Drawer Header --}}
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-dark text-base">Keranjang Belanja</h3>
                <p id="cart-count-text" class="text-xs text-gray-400">0 item</p>
            </div>
        </div>
        <button id="close-cart-btn" class="p-2 rounded-xl hover:bg-gray-100 transition-colors" aria-label="Tutup">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Cart Items --}}
    <div class="flex-1 overflow-y-auto py-4" id="cart-items-container">
        {{-- Empty State --}}
        <div id="cart-empty" class="flex flex-col items-center justify-center h-full py-16 text-center px-6">
            <div class="w-20 h-20 bg-surface rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
            </div>
            <h4 class="text-base font-semibold text-gray-400 mb-1">Keranjang kosong</h4>
            <p class="text-sm text-gray-300">Tambahkan produk benih untuk memulai</p>
        </div>

        {{-- Cart Items List --}}
        <div id="cart-items-list" class="px-4 space-y-3 hidden"></div>
    </div>

    {{-- Cart Footer --}}
    <div id="cart-footer" class="border-t border-gray-100 px-6 py-5 bg-white hidden">
        {{-- Subtotal --}}
        <div class="flex items-center justify-between mb-1">
            <span class="text-sm text-gray-500">Subtotal</span>
            <span id="cart-subtotal" class="text-base font-bold text-dark">Rp 0</span>
        </div>
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs text-gray-400">Ongkir dihitung saat checkout</span>
            <span class="text-xs text-gray-400" id="cart-total-qty">0 kg</span>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-3">
            <button id="clear-cart-btn"
                    class="px-4 py-3 border border-gray-200 text-gray-500 text-sm font-medium rounded-xl hover:bg-red-50 hover:text-accent hover:border-accent transition-all duration-200">
                Kosongkan
            </button>
            <a href="/checkout?role={{ $role }}"
               class="flex-1 flex items-center justify-center gap-2 py-3 bg-primary text-white font-semibold text-sm rounded-xl
                      hover:bg-primary-light transition-all duration-200 hover:shadow-lg hover:shadow-primary/20">
                Checkout
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>


{{-- ============================================ --}}
{{-- TOAST NOTIFICATION                           --}}
{{-- ============================================ --}}
<div id="toast"
     class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[60] flex items-center gap-2 px-5 py-3 bg-dark text-white text-sm font-medium rounded-2xl shadow-xl
            translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
    <svg class="w-4 h-4 text-secondary-light shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span id="toast-message">Produk ditambahkan</span>
</div>

@endsection


@push('scripts')
<script>
// ====================================================
// Cart Manager
// ====================================================
const CART_KEY = 'benihrakyat_cart';

let cart = JSON.parse(localStorage.getItem(CART_KEY) || '[]');

// ---- Cart CRUD ----
function saveCart() {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function addToCart(product) {
    const qtyInput = document.getElementById(`qty-${product.id}`);
    const qty = parseInt(qtyInput?.value || 1);

    const existing = cart.find(i => String(i.id) === String(product.id));
    if (existing) {
        existing.qty = Math.min(existing.qty + qty, product.stock);
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            category: product.category,
            price: product.price,
            unit: product.unit,
            image: product.image,
            stock: product.stock,
            qty: qty,
        });
    }

    if (qtyInput) qtyInput.value = 1;

    saveCart();
    renderCart();
    bumpBadge();
    showToast(`${product.name} ditambahkan ke keranjang`);
}

function removeFromCart(id) {
    const item = document.querySelector(`[data-cart-id="${id}"]`);
    if (item) {
        item.classList.add('removing');
        setTimeout(() => {
            cart = cart.filter(i => String(i.id) !== String(id));
            saveCart();
            renderCart();
        }, 200);
    }
}

function updateCartQty(id, newQty) {
    const item = cart.find(i => String(i.id) === String(id));
    if (!item) return;
    newQty = Math.max(1, Math.min(newQty, item.stock));
    item.qty = newQty;
    saveCart();
    renderCart();
}

function clearCart() {
    cart = [];
    saveCart();
    renderCart();
}

// ---- Compute Totals ----
function getCartTotal() {
    return cart.reduce((sum, i) => sum + i.price * i.qty, 0);
}
function getCartTotalQty() {
    return cart.reduce((sum, i) => sum + i.qty, 0);
}
function getCartCount() {
    return cart.length;
}

// ---- Render ----
function renderCart() {
    const empty  = document.getElementById('cart-empty');
    const list   = document.getElementById('cart-items-list');
    const footer = document.getElementById('cart-footer');
    const badge  = document.getElementById('cart-badge');
    const countText = document.getElementById('cart-count-text');
    const subtotal  = document.getElementById('cart-subtotal');
    const totalQty  = document.getElementById('cart-total-qty');

    const count = getCartCount();

    // Badge
    if (count > 0) {
        badge.textContent = count;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }

    // Count text
    countText.textContent = `${count} item`;

    if (count === 0) {
        empty.classList.remove('hidden');
        list.classList.add('hidden');
        footer.classList.add('hidden');
        return;
    }

    empty.classList.add('hidden');
    list.classList.remove('hidden');
    footer.classList.remove('hidden');

    // Render items
    list.innerHTML = cart.map(item => {
        let imgSrc = item.image;
        if (!imgSrc.startsWith('http') && !imgSrc.startsWith('/')) {
            imgSrc = '/images/' + item.image;
        }
        let fallback = item.category === 'jagung' ? '/images/product-jagung.png' : '/images/product-padi.png';
        
        return `
        <div class="cart-item flex gap-3 bg-surface rounded-2xl p-3 border border-gray-100" data-cart-id="${item.id}">
            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-gray-50">
                <img src="${imgSrc}" alt="${item.name}"
                     class="w-full h-full object-cover"
                     onerror="this.src='${fallback}'">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-dark truncate">${item.name}</p>
                <p class="text-xs text-gray-400 mb-2">Rp ${formatRupiah(item.price)} / ${item.unit}</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                        <button onclick="updateCartQty(${item.id}, ${item.qty - 1})"
                                class="w-7 h-7 flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-colors text-base font-medium border-r border-gray-200">
                            −
                        </button>
                        <span class="w-8 text-center text-sm font-semibold text-dark">${item.qty}</span>
                        <button onclick="updateCartQty(${item.id}, ${item.qty + 1})"
                                class="w-7 h-7 flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-colors text-base font-medium border-l border-gray-200">
                            +
                        </button>
                    </div>
                    <p class="text-sm font-bold text-primary">Rp ${formatRupiah(item.price * item.qty)}</p>
                </div>
            </div>
            <button onclick="removeFromCart(${item.id})"
                    class="p-1 text-gray-300 hover:text-accent transition-colors self-start mt-1 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        `;
    }).join('');

    // Totals
    subtotal.textContent = `Rp ${formatRupiah(getCartTotal())}`;
    totalQty.textContent = `Total ${getCartTotalQty()} kg`;
}

// ---- Helpers ----
function formatRupiah(num) {
    return num.toLocaleString('id-ID');
}

function formatRupiahFull(num) {
    return 'Rp ' + num.toLocaleString('id-ID');
}

function bumpBadge() {
    const badge = document.getElementById('cart-badge');
    badge.classList.add('bump');
    setTimeout(() => badge.classList.remove('bump'), 300);
}

function showToast(message) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-message').textContent = message;
    toast.classList.remove('translate-y-20', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');
    setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
        toast.classList.remove('translate-y-0', 'opacity-100');
    }, 2500);
}

// ---- Qty helpers for product cards ----
function increaseQty(id, max) {
    const input = document.getElementById(`qty-${id}`);
    if (input) input.value = Math.min(parseInt(input.value) + 1, max);
}

function decreaseQty(id) {
    const input = document.getElementById(`qty-${id}`);
    if (input) input.value = Math.max(parseInt(input.value) - 1, 1);
}

// ====================================================
// Cart Drawer Toggle
// ====================================================
const cartDrawer   = document.getElementById('cart-drawer');
const cartBackdrop = document.getElementById('cart-backdrop');
const openBtn      = document.getElementById('open-cart-btn');
const closeBtn     = document.getElementById('close-cart-btn');
const clearBtn     = document.getElementById('clear-cart-btn');

function openCart()  {
    cartDrawer.classList.add('open');
    cartBackdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeCart() {
    cartDrawer.classList.remove('open');
    cartBackdrop.classList.remove('open');
    document.body.style.overflow = '';
}

openBtn.addEventListener('click', openCart);
closeBtn.addEventListener('click', closeCart);
cartBackdrop.addEventListener('click', closeCart);
clearBtn.addEventListener('click', () => {
    if (confirm('Kosongkan semua item di keranjang?')) clearCart();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeCart(); });

// ====================================================
// Search Filter
// ====================================================
document.getElementById('search-input').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    
    document.querySelectorAll('.product-card').forEach(card => {
        const productName = card.querySelector('.product-title').innerText.toLowerCase();
        if (productName.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});

// ====================================================
// Init
// ====================================================
renderCart();
</script>
@endpush
