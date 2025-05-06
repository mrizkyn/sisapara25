<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if (User::create($validatedData)) {
            return redirect()->route('login')->with('success', 'Registrasi berhasil. Silahkan login.');
        } else {
            return redirect()->back()->with('error', 'Registrasi gagal. Silahkan coba lagi.');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil.');
            } elseif ($role === 'superadmin') {
                return redirect()->intended(route('superadmin.dashboard'))->with('success', 'Login berhasil.');
            } elseif ($role === 'user') {
                return redirect()->intended(route('user.dashboard'))->with('success', 'Login berhasil.');
            }
        }

        return back()->with('error', 'Login gagal. Silahkan periksa email dan password Anda.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}
