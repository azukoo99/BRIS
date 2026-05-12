<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengguna;

class UserController extends Controller
{
    public function index()
    {
        // Don't list the currently logged in admin to prevent them from locking themselves out
        $users = Pengguna::where('id', '!=', auth()->id())->get();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,pelanggan,investor',
        ]);

        $user = Pengguna::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
