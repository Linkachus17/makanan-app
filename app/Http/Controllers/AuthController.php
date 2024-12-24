<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect berdasarkan role
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->intended('/operator');
            } elseif ($user->role_id == 2) {
                return redirect()->intended('/operator');
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Username atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Ganti dengan route login
    }
}
