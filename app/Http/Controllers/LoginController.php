<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Ambil kredensial dari input
        $credentials = $request->only('email', 'password');
    
        // Proses login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Cek role pengguna
            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('user.index');
            }
        }
    
        // Jika login gagal
        return back()->withErrors(['login' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

    
}
