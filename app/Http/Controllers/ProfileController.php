<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $rules = [];
        
        // Admin hanya bisa update password, sisanya diabaikan
        if ($user->role !== 'admin') {
            $rules['nama'] = 'required|string|max:100|unique:pengguna,nama,' . $user->id;
            $rules['no_telp'] = 'nullable|string|max:20';
        }
        
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }
        
        $validated = $request->validate($rules);
        
        // Update basic info for non-admin
        if ($user->role !== 'admin') {
            if (isset($validated['nama'])) $user->nama = $validated['nama'];
            if (isset($validated['no_telp'])) $user->no_telp = $validated['no_telp'];
        }
        
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
