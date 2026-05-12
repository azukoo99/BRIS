@extends('layouts.app')

@section('title', 'Registrasi - CV. Benih Rakyat')

@section('content')
<section class="min-h-screen flex items-center justify-center py-24 bg-surface relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/3"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-gold/10 rounded-full blur-3xl translate-y-1/3 translate-x-1/3"></div>

    <div class="max-w-xl w-full px-6 relative z-10 fade-up">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/50">
            
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 mb-6 group">
                    <img src="{{ asset('images/logo.png') }}" alt="BRIS Logo" class="h-10 w-auto group-hover:scale-105 transition-transform">
                    <div class="text-left">
                        <p class="text-lg font-bold text-primary leading-tight tracking-wide">BRIS</p>
                        <p class="text-[10px] font-medium text-gray-500 leading-tight uppercase tracking-wider">CV. Benih Rakyat</p>
                    </div>
                </a>
                <h2 class="text-2xl font-bold text-dark mb-2">Buat Akun Baru</h2>
                <p class="text-sm text-gray-500">Daftar sebagai pelanggan untuk mulai bertransaksi.</p>
            </div>

            <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('nama') border-red-500 @enderror" placeholder="Masukkan nama lengkap">
                    @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('email') border-red-500 @enderror" placeholder="contoh@gmail.com">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('password') border-red-500 @enderror" placeholder="Minimal 6 karakter">
                        @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="Ulangi password">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon (Opsional)</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="0812xxxxxx">
                </div>

                <button type="submit" class="w-full py-3 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20 mt-4">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Sudah punya akun? <a href="{{ url('/login') }}" class="font-bold text-primary hover:text-primary-light transition-colors">Masuk di sini</a>
            </div>
        </div>
    </div>
</section>
@endsection
