@extends('layouts.app')

@section('title', 'Login - CV. Benih Rakyat')

@section('content')
<section class="min-h-screen flex items-center justify-center py-20 bg-surface relative overflow-hidden">
    {{-- Decorative bg --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gold/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>

    <div class="max-w-md w-full px-6 relative z-10 fade-up">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/50 text-center">
            
            <a href="/" class="inline-flex items-center gap-2 mb-8 group">
                <img src="{{ asset('images/logo.png') }}" alt="BRIS Logo" class="h-10 w-auto group-hover:scale-105 transition-transform">
                <div class="text-left">
                    <p class="text-lg font-bold text-primary leading-tight tracking-wide">BRIS</p>
                    <p class="text-[10px] font-medium text-gray-500 leading-tight uppercase tracking-wider">CV. Benih Rakyat</p>
                </div>
            </a>

            <h2 class="text-2xl font-bold text-dark mb-2">Selamat Datang Kembali</h2>
            <p class="text-sm text-gray-500 mb-8">Silakan masuk ke akun Anda untuk melanjutkan.</p>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-600 text-sm font-medium rounded-xl border border-green-100">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-5 text-left">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror" placeholder="contoh@gmail.com">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="{{ url('/forgot-password') }}" class="text-xs font-semibold text-primary hover:text-primary-light transition-colors">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="Masukkan password Anda">
                </div>

                <button type="submit" class="w-full py-3 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20 mt-2">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 text-sm text-gray-500">
                Belum punya akun? <a href="{{ url('/register') }}" class="font-bold text-primary hover:text-primary-light transition-colors">Daftar di sini</a>
            </div>
        </div>
    </div>
</section>
@endsection
