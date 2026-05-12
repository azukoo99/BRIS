`{{-- ============================================ --}}
{{-- Navbar Component - Role Based Navigation    --}}
{{-- ============================================ --}}

@php
    $role = Auth::check() ? Auth::user()->role : 'guest';
    $isLoggedIn = Auth::check();

    $navItems = [
        'guest' => [
            ['label' => 'Beranda', 'href' => '/', 'icon' => 'home'],
            ['label' => 'Tentang Kami', 'href' => '#tentang', 'icon' => 'info'],
            ['label' => 'Produk', 'href' => '#produk', 'icon' => 'package'],
            ['label' => 'Investor', 'href' => '#investor', 'icon' => 'chart'],
        ],
        'admin' => [
            ['label' => 'Beranda', 'href' => '/', 'icon' => 'home'],
            ['label' => 'Kelola Produk', 'href' => '/admin/produk', 'icon' => 'package'],
            ['label' => 'Pesanan', 'href' => '/admin/pesanan', 'icon' => 'cart'],
            ['label' => 'Kelola User', 'href' => '/admin/users', 'icon' => 'profile'],
            ['label' => 'Laporan Keuangan', 'href' => '/laporan', 'icon' => 'chart'],
        ],
        'pelanggan' => [
            ['label' => 'Beranda', 'href' => '/', 'icon' => 'home'],
            ['label' => 'Produk', 'href' => '/produk', 'icon' => 'package'],
            ['label' => 'History', 'href' => '/history', 'icon' => 'history'],
        ],
        'investor' => [
            ['label' => 'Beranda', 'href' => '/', 'icon' => 'home'],
            ['label' => 'Produk', 'href' => '/produk', 'icon' => 'package'],
            ['label' => 'Laporan Keuangan', 'href' => '/laporan', 'icon' => 'chart'],
        ],
    ];

    $currentNav = $navItems[$role] ?? $navItems['guest'];
@endphp

{{-- Desktop Navbar --}}
<nav id="navbar" class="glass-nav fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 shrink-0 group" id="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="CV. Benih Rakyat" class="h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                <div class="hidden sm:block">
                    <p class="text-lg font-bold text-primary leading-tight tracking-wide">BRIS</p>
                    <p class="text-[10px] font-medium text-gray-500 leading-tight uppercase tracking-wider">CV. Benih Rakyat</p>
                </div>
            </a>

            {{-- Desktop Nav Links --}}
            <div class="hidden lg:flex items-center gap-1">
                @foreach ($currentNav as $item)
                    <a href="{{ $item['href'] }}"
                       class="relative px-4 py-2 text-sm font-medium text-gray-600 rounded-lg
                              hover:text-primary hover:bg-primary/5
                              transition-all duration-200
                              {{ request()->is(ltrim($item['href'], '/')) || (request()->is('/') && $item['href'] === '/') ? 'text-primary bg-primary/5' : '' }}"
                       id="nav-{{ Str::slug($item['label']) }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Right Side: Login / Profile --}}
            <div class="hidden lg:flex items-center gap-3">
                @if ($isLoggedIn)
                    {{-- Profile dropdown --}}
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $role }}
                        </span>
                        <div class="relative group">
                            <button class="flex items-center gap-2 px-4 py-2 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-light transition-all duration-200 hover:shadow-lg hover:shadow-primary/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-colors">Profil Saya</a>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-b-xl border-t border-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/login"
                       class="px-6 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl
                              hover:bg-primary-light transition-all duration-200
                              hover:shadow-lg hover:shadow-primary/20"
                       id="nav-login-btn">
                        Login
                    </a>
                @endif
            </div>

            {{-- Mobile Hamburger --}}
            <button id="hamburger-btn" class="lg:hidden flex flex-col gap-1.5 p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Menu">
                <span class="w-6 h-0.5 bg-primary rounded-full transition-all duration-300"></span>
                <span class="w-6 h-0.5 bg-primary rounded-full transition-all duration-300"></span>
                <span class="w-4 h-0.5 bg-primary rounded-full transition-all duration-300"></span>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Menu Backdrop --}}
<div id="mobile-backdrop" class="mobile-backdrop fixed inset-0 z-50 bg-black/40"></div>

{{-- Mobile Menu Drawer --}}
<div id="mobile-menu" class="mobile-menu fixed top-0 right-0 bottom-0 z-50 w-80 max-w-[85vw] bg-white shadow-2xl flex flex-col">
    {{-- Mobile Header --}}
    <div class="flex items-center justify-between p-5 border-b border-gray-100">
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="BRIS" class="h-8 w-auto">
            <div class="flex flex-col">
                <span class="text-base font-bold text-primary leading-none tracking-wide">BRIS</span>
                <span class="text-[9px] font-medium text-gray-500 leading-tight uppercase mt-0.5">CV. Benih Rakyat</span>
            </div>
        </a>
        <button id="mobile-close-btn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Tutup">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Role Badge --}}
    @if ($isLoggedIn)
        <div class="px-5 py-3 bg-primary/5">
            <span class="text-xs font-semibold text-primary uppercase tracking-wider">{{ $role }}</span>
        </div>
    @endif

    {{-- Mobile Nav Links --}}
    <div class="flex-1 overflow-y-auto py-4">
        @foreach ($currentNav as $item)
            <a href="{{ $item['href'] }}"
               class="flex items-center gap-3 px-5 py-3.5 text-sm font-medium text-gray-700
                      hover:bg-primary/5 hover:text-primary transition-all duration-200
                      {{ request()->is(ltrim($item['href'], '/')) ? 'text-primary bg-primary/5 border-r-3 border-primary' : '' }}">
                {{-- Icons --}}
                @if ($item['icon'] === 'home')
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                @elseif ($item['icon'] === 'info')
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif ($item['icon'] === 'package')
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                @elseif ($item['icon'] === 'cart')
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                @elseif ($item['icon'] === 'history')
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif ($item['icon'] === 'chart')
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                @endif
                {{ $item['label'] }}
            </a>
        @endforeach
    </div>

    {{-- Mobile Footer --}}
    <div class="p-5 border-t border-gray-100">
        @if ($isLoggedIn)
            <div class="flex flex-col gap-2">
                <a href="/profile"
                   class="flex items-center justify-center gap-2 w-full py-3 bg-primary text-white text-sm font-semibold rounded-xl
                          hover:bg-primary-light transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full py-3 bg-red-50 text-red-600 text-sm font-semibold rounded-xl hover:bg-red-100 transition-all duration-200">
                        Logout
                    </button>
                </form>
            </div>
        @else
            <a href="/login"
               class="flex items-center justify-center w-full py-3 bg-primary text-white text-sm font-semibold rounded-xl
              .399        hover:bg-primary-light transition-all duration-200">
                Login
            </a>
        @endif
    </div>
</div>

{{-- Navbar spacer --}}
<div class="h-18"></div>
