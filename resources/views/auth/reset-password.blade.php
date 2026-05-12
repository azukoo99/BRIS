@extends('layouts.app')

@section('title', 'Reset Password - CV. Benih Rakyat')

@section('content')
<section class="min-h-screen flex items-center justify-center py-20 bg-surface relative overflow-hidden">
    <div class="max-w-md w-full px-6 relative z-10 fade-up">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/50 text-center">
            
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>

            <h2 class="text-2xl font-bold text-dark mb-2">Buat Password Baru</h2>
            <p class="text-sm text-gray-500 mb-8">Silakan buat password baru untuk akun Anda.</p>

            <form action="{{ url('/reset-password') }}" method="POST" class="space-y-5 text-left">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                    <input type="password" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors @error('password') border-red-500 @enderror" placeholder="Minimal 6 karakter">
                    @error('password') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="w-full py-3 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-500 transition-all shadow-lg shadow-green-500/20">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
