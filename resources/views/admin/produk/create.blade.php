@extends('layouts.app')

@section('title', 'Tambah Produk - Admin Panel')

@section('content')
<section class="pt-32 pb-20 bg-surface min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center gap-4">
    <a href="{{ route('admin.produk.index') }}" class="p-2 bg-white text-gray-600 rounded-xl border border-gray-200 hover:bg-gray-50 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Tambah Produk Baru</h1>
        <p class="text-gray-500 text-sm">Masukkan detail informasi produk.</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                @error('nama') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                @error('harga') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
                <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                @error('stok') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" id="gambar" name="gambar" accept="image/*" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                @error('gambar') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status Aktif <span class="text-red-500">*</span></label>
                <select id="is_active" name="is_active" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all bg-white">
                    <option value="yes" {{ old('is_active') == 'yes' ? 'selected' : '' }}>Aktif (Tampilkan)</option>
                    <option value="no" {{ old('is_active') == 'no' ? 'selected' : '' }}>Tidak Aktif (Sembunyikan)</option>
                </select>
                @error('is_active') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.produk.index', ['role' => 'admin']) }}" class="px-6 py-3 text-gray-600 font-medium hover:text-gray-900 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-primary text-white font-medium rounded-xl hover:bg-primary-light transition-all shadow-lg shadow-primary/20">
                Simpan Produk
            </button>
        </div>
    </form>
</div>
    </div>
</section>
@endsection
