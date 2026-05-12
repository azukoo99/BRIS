@extends('layouts.app')

@section('title', 'Kelola User - Admin Panel')

@section('content')
<section class="pt-32 pb-20 bg-surface min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 fade-up">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Daftar Pengguna</h1>
                <p class="text-gray-500 text-sm">Kelola akun pengguna dan atur hak akses (role) mereka.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center gap-3 fade-up">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden fade-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Nama / Email</th>
                            <th scope="col" class="px-6 py-4 font-medium">No. Telepon</th>
                            <th scope="col" class="px-6 py-4 font-medium">Role Saat Ini</th>
                            <th scope="col" class="px-6 py-4 font-medium text-right">Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $user->nama }}</div>
                                    <div class="text-xs text-gray-400">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->no_telp ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Admin</span>
                                    @elseif($user->role === 'investor')
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">Investor</span>
                                    @else
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">Pelanggan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ url('/admin/users/' . $user->id . '/role') }}" method="POST" class="flex items-center justify-end gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" class="text-xs bg-white border border-gray-200 text-gray-700 rounded-lg px-2 py-1.5 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                            <option value="pelanggan" {{ $user->role === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                            <option value="investor" {{ $user->role === 'investor' ? 'selected' : '' }}>Investor</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="px-3 py-1.5 bg-dark text-white text-xs font-medium rounded-lg hover:bg-gray-800 transition-colors">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Belum ada pengguna lain terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
