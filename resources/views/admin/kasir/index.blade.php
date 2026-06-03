@extends('layouts.app')

@section('title', 'Kasir (POS) - Admin Panel')

@push('styles')
<style>
    .product-card { transition: all 0.2s ease; }
    .product-card:active { transform: scale(0.96); }
    
    /* Scrollbar for cart */
    .cart-scroll::-webkit-scrollbar { width: 4px; }
    .cart-scroll::-webkit-scrollbar-track { background: transparent; }
    .cart-scroll::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 4px; }
    .cart-scroll:hover::-webkit-scrollbar-thumb { background: #D1D5DB; }
</style>
@endpush

@section('content')
<section class="pt-24 pb-12 bg-surface min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Menu Kasir</h1>
            </div>
            
            {{-- Search Bar --}}
            <div class="relative w-full sm:max-w-xs">
                <input type="text" id="search-input" placeholder="Cari benih produk..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all shadow-sm">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            
            {{-- Kiri: Daftar Produk --}}
            <div class="flex-1">
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4" id="products-grid">
                    @forelse ($produks as $p)
                        @php
                            $fallbackImage = strpos(strtolower($p->nama), 'jagung') !== false ? asset('images/product-jagung.png') : asset('images/product-padi.png');
                            $image = $p->gambar ? asset($p->gambar) : $fallbackImage;
                        @endphp
                        <div class="product-item bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm cursor-pointer hover:shadow-md transition-shadow group flex flex-col"
                             onclick="addToCart({{ $p->id }}, '{{ addslashes($p->nama) }}', {{ $p->harga }}, '{{ $image }}', {{ $p->stok }})">
                            <div class="h-32 bg-gray-50 relative overflow-hidden">
                                <img src="{{ $image }}" alt="{{ $p->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @if ($p->stok <= 10)
                                    <div class="absolute bottom-2 right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                                        Stok: {{ $p->stok }}
                                    </div>
                                @else
                                    <div class="absolute bottom-2 right-2 bg-black/50 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                                        Stok: {{ $p->stok }}
                                    </div>
                                @endif
                            </div>
                            <div class="p-3 flex-1 flex flex-col justify-between">
                                <h3 class="product-title text-sm font-bold text-dark leading-tight mb-2 line-clamp-2">{{ $p->nama }}</h3>
                                <div class="text-primary font-bold text-sm">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-500 bg-white rounded-2xl border border-gray-100">
                            Tidak ada produk aktif saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Kanan: Keranjang Kasir --}}
            <div class="w-full lg:w-96 shrink-0 flex flex-col h-[calc(100vh-10rem)] sticky top-24">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                        <h2 class="font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            Pesanan Saat Ini
                        </h2>
                        <span id="cart-count" class="bg-primary/10 text-primary text-xs font-bold px-2 py-1 rounded-lg">0 item</span>
                    </div>

                    {{-- Cart Items --}}
                    <div class="flex-1 overflow-y-auto cart-scroll p-4 space-y-4" id="cart-items">
                        <div class="h-full flex flex-col items-center justify-center text-gray-400 p-6 text-center" id="empty-cart-state">
                            <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <p class="text-sm">Keranjang kosong.<br>Pilih produk di samping untuk memulai.</p>
                        </div>
                        {{-- Items akan di-render di sini via JS --}}
                    </div>

                    {{-- Total & Checkout --}}
                    <div class="p-5 bg-gray-50 border-t border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-medium text-gray-500">Total Tagihan</span>
                            <span class="text-2xl font-black text-dark" id="cart-total">Rp 0</span>
                        </div>
                        
                        <button id="btn-checkout" class="w-full py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary-light transition-all shadow-lg hover:shadow-primary/25 disabled:bg-gray-300 disabled:shadow-none disabled:cursor-not-allowed">
                            Proses Pembayaran
                        </button>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
</section>

{{-- Modal Pembayaran Sukses --}}
<div id="modal-success" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeSuccessModal()"></div>
    <div class="relative bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl scale-95 opacity-0 transition-all duration-300" id="modal-success-content">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-dark mb-2">Transaksi Berhasil!</h3>
        <p class="text-sm text-gray-500 mb-6">Transaksi kasir telah dicatat.</p>
        <button onclick="closeSuccessModal()" class="block w-full py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary-light transition-colors shadow-lg shadow-primary/20">
            Kembali ke Kasir
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // State
    let cart = [];
    
    // Elements
    const emptyState = document.getElementById('empty-cart-state');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartCountEl = document.getElementById('cart-count');
    const cartTotalEl = document.getElementById('cart-total');
    const btnCheckout = document.getElementById('btn-checkout');
    
    // Tools
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }
    
    function renderCart() {
        if (cart.length === 0) {
            emptyState.style.display = 'flex';
            btnCheckout.disabled = true;
            cartItemsContainer.innerHTML = '';
            cartItemsContainer.appendChild(emptyState);
            cartCountEl.textContent = '0 item';
            cartTotalEl.textContent = 'Rp 0';
            return;
        }

        emptyState.style.display = 'none';
        btnCheckout.disabled = false;
        
        let html = '';
        let total = 0;
        let count = 0;
        
        cart.forEach((item, index) => {
            const subtotal = item.price * item.qty;
            total += subtotal;
            count += item.qty;
            
            html += `
                <div class="flex gap-3 bg-white p-3 rounded-xl border border-gray-100 shadow-sm relative group">
                    <img src="${item.image}" alt="${item.name}" class="w-14 h-14 rounded-lg object-cover shrink-0">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-gray-800 truncate pr-6">${item.name}</h4>
                        <div class="text-primary text-xs font-semibold mb-2">${formatRupiah(item.price)}</div>
                        
                        <div class="flex items-center gap-2">
                            <button onclick="updateQty(${index}, -1)" class="w-6 h-6 rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200 flex items-center justify-center font-medium">-</button>
                            <span class="text-sm font-semibold w-4 text-center">${item.qty}</span>
                            <button onclick="updateQty(${index}, 1)" class="w-6 h-6 rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200 flex items-center justify-center font-medium">+</button>
                        </div>
                    </div>
                    
                    <button onclick="removeItem(${index})" class="absolute top-2 right-2 text-gray-300 hover:text-red-500 transition-colors p-1" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    
                    <div class="absolute bottom-3 right-3 text-sm font-bold text-dark">
                        ${formatRupiah(subtotal)}
                    </div>
                </div>
            `;
        });
        
        cartItemsContainer.innerHTML = html;
        cartCountEl.textContent = count + ' item';
        cartTotalEl.textContent = formatRupiah(total).replace(',00', '');
    }

    // Actions
    window.addToCart = function(id, name, price, image, maxStok) {
        if (maxStok <= 0) {
            alert('Stok produk habis!');
            return;
        }

        const existingItem = cart.find(i => i.id === id);
        if (existingItem) {
            if (existingItem.qty < maxStok) {
                existingItem.qty++;
            } else {
                alert('Maksimal stok tercapai!');
            }
        } else {
            cart.push({ id, name, price, image, maxStok, qty: 1 });
        }
        renderCart();
    }

    window.updateQty = function(index, change) {
        const item = cart[index];
        const newQty = item.qty + change;
        
        if (newQty <= 0) {
            removeItem(index);
        } else if (newQty > item.maxStok) {
            alert('Maksimal stok tercapai!');
        } else {
            item.qty = newQty;
            renderCart();
        }
    }

    window.removeItem = function(index) {
        cart.splice(index, 1);
        renderCart();
    }

    // Search
    document.getElementById('search-input').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.product-item').forEach(item => {
            const title = item.querySelector('.product-title').innerText.toLowerCase();
            item.style.display = title.includes(term) ? '' : 'none';
        });
    });

    // Checkout Check
    btnCheckout.addEventListener('click', async function() {
        if (cart.length === 0) return;
        
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...</span>';
        btn.disabled = true;

        try {
            const response = await fetch('{{ route("admin.kasir.checkout") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ items: cart })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Show modal success
                const modal = document.getElementById('modal-success');
                const content = document.getElementById('modal-success-content');
                
                modal.classList.remove('hidden');
                
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                alert(data.message || 'Terjadi kesalahan saat memproses pembayaran.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        } catch (error) {
            alert('Kesalahan jaringan. Gagal memproses transaksi.');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

    // Close success modal and reload to clear state
    window.closeSuccessModal = function() {
        const modal = document.getElementById('modal-success');
        const content = document.getElementById('modal-success-content');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            window.location.reload();
        }, 300);
    }

    // Initialize
    renderCart();
</script>
@endpush
