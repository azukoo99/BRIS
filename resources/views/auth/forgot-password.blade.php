@extends('layouts.app')

@section('title', 'Lupa Password - CV. Benih Rakyat')

@section('content')
<section class="min-h-screen flex items-center justify-center py-20 bg-surface relative overflow-hidden">
    <div class="max-w-md w-full px-6 relative z-10 fade-up">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/50 text-center">
            
            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
            </div>

            <h2 class="text-2xl font-bold text-dark mb-2">Lupa Password?</h2>
            <p class="text-sm text-gray-500 mb-8">Masukkan email yang terdaftar, kami akan mengirimkan kode OTP untuk mereset password Anda.</p>

            <form action="{{ url('/forgot-password') }}" method="POST" class="space-y-5 text-left">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Terdaftar</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('email') border-red-500 @enderror" placeholder="contoh@gmail.com">
                    @error('email') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-primary text-white text-sm font-bold rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20">
                    Kirim Kode OTP
                </button>
            </form>

            <div class="mt-8 text-sm text-gray-500">
                <a href="{{ url('/login') }}" class="font-bold text-primary hover:text-primary-light transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
