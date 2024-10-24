<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users', // Validasi email
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru dengan role 'user'
        User::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email, // Simpan email
            'password' => Hash::make($request->password),
            'role' => 'user', // Menetapkan role 'user' default
        ]);

        // Redirect ke halaman login setelah berhasil registrasi
        return redirect()->route('login')->with('success', 'Akun user berhasil dibuat. Silakan login.');
    }
}
