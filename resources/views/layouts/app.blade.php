<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CV. Benih Rakyat - Penyedia benih unggul, terpercaya, dan berdaya saing untuk ketahanan pangan nasional Indonesia.">

    <title>@yield('title', 'CV. Benih Rakyat - Benih Hebat Untuk Rakyat Sejahtera')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Global & Navbar Styles */
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(27, 67, 50, 0.08);
        }
        .glass-nav.scrolled {
            background: rgba(255, 255, 255, 0.97);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .mobile-menu.open { transform: translateX(0); }
        
        .mobile-backdrop {
            opacity: 0; pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .mobile-backdrop.open { opacity: 1; pointer-events: auto; }
    </style>

    <!-- ✅ Page-specific styles (dari @push('styles') di tiap view) -->
    @stack('styles')
</head>
<body class="font-sans antialiased text-dark bg-white">
    {{-- Navbar --}}
    @if(!request()->routeIs('login', 'register', 'password.request', 'password.email', 'password.verify', 'password.reset'))
        @include('components.navbar')
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @if(!request()->routeIs('login', 'register', 'password.request', 'password.email', 'password.verify', 'password.reset'))
        @include('components.footer')
    @endif

    <!-- ✅ Page-specific scripts (dari @push('scripts') di tiap view) -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Navbar Scroll Effect
            const navbar = document.getElementById('navbar');
            if (navbar) {
                const handleScroll = () => {
                    if (window.scrollY > 50) navbar.classList.add('scrolled');
                    else navbar.classList.remove('scrolled');
                };
                window.addEventListener('scroll', handleScroll, { passive: true });
                handleScroll();
            }

            // Mobile Menu Toggle
            const hamburger = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const backdrop = document.getElementById('mobile-backdrop');
            const closeBtn = document.getElementById('mobile-close-btn');

            if (hamburger && mobileMenu) {
                const openMenu = () => {
                    mobileMenu.classList.add('open');
                    if (backdrop) backdrop.classList.add('open');
                    document.body.style.overflow = 'hidden';
                };

                const closeMenu = () => {
                    mobileMenu.classList.remove('open');
                    if (backdrop) backdrop.classList.remove('open');
                    document.body.style.overflow = '';
                };

                hamburger.addEventListener('click', openMenu);
                if (closeBtn) closeBtn.addEventListener('click', closeMenu);
                if (backdrop) backdrop.addEventListener('click', closeMenu);

                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', closeMenu);
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') closeMenu();
                });
            }
        });
    </script>
</body>
</html>
