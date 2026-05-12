@extends('layouts.app')

@section('title', 'Profil Saya - CV. Benih Rakyat')

@section('content')
<section class="pt-32 pb-20 bg-surface min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center gap-4 fade-up">
            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-dark mb-1">Profil Saya</h1>
                <p class="text-gray-500 text-sm">Kelola informasi data diri dan keamanan akun Anda.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 fade-up">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 fade-up">
                <div class="flex items-center gap-3 mb-2 font-semibold">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Terdapat kesalahan pengisian:
                </div>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden fade-up fade-up-delay-1">
            <form action="{{ route('profile.update') }}" method="POST" class="p-6 sm:p-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    {{-- Role Info Badge --}}
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-accent/10 text-accent' : 'bg-primary/10 text-primary' }}">
                            Role: {{ $user->role }}
                        </span>
                        @if($user->role === 'admin')
                            <p class="text-xs text-gray-400 mt-2">Sebagai Admin, Anda hanya dapat mengubah password.</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama / Username</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" {{ $user->role === 'admin' ? 'disabled' : '' }} class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
                        </div>

                        {{-- Email (Read Only) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-xs text-gray-400 font-normal">(Tidak bisa diubah)</span></label>
                            <input type="email" value="{{ $user->email }}" disabled class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-sm text-gray-500 cursor-not-allowed">
                        </div>

                        {{-- No Telp --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon</label>
                            <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" {{ $user->role === 'admin' ? 'disabled' : '' }} class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
                        </div>
                    </div>

                    <hr class="border-gray-100 my-8">

                    <div>
                        <h3 class="text-lg font-bold text-dark mb-1">Ganti Password</h3>
                        <p class="text-xs text-gray-500 mb-6">Biarkan kosong jika tidak ingin mengganti password.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                                <input type="password" name="password" placeholder="Minimal 6 karakter" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password baru" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection
