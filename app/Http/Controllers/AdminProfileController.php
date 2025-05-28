<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id', Auth::id())->first();


        return view('admin.profiles.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== Auth::id()) {
            return redirect()->route('admin.profiles.index')->with('error', 'Anda tidak memiliki akses.');
        }
        return view('admin.profiles.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }



        $user->update($validated);

        return redirect()->route('admin.profiles.index')->with('success', 'Data admin berhasil diperbarui.');
    }
}
