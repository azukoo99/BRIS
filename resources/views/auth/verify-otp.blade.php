@extends('layouts.app')

@section('title', 'Verifikasi OTP - CV. Benih Rakyat')

@section('content')
<section class="min-h-screen flex items-center justify-center py-20 bg-surface relative overflow-hidden">
    <div class="max-w-md w-full px-6 relative z-10 fade-up">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/50 text-center">
            
            <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-secondary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/></svg>
            </div>

            <h2 class="text-2xl font-bold text-dark mb-2">Verifikasi OTP</h2>
            <p class="text-sm text-gray-500 mb-8">Masukkan 6 digit kode OTP yang telah dikirimkan ke email <span class="font-bold text-dark">{{ Session::get('reset_email') }}</span>.</p>

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-600 text-sm font-medium rounded-xl border border-green-100">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ url('/verify-otp') }}" method="POST" class="space-y-5 text-left">
                @csrf
                <div>
                    <input type="text" name="otp" required maxlength="6" class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-center text-2xl tracking-[0.5em] font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('otp') border-red-500 @enderror" placeholder="••••••">
                    @error('otp') <p class="mt-2 text-center text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full py-3 bg-secondary text-white text-sm font-bold rounded-xl hover:bg-secondary-light transition-all shadow-lg shadow-secondary/20">
                    Verifikasi Kode
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
