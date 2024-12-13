<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan Form Loin
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan Form Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Menangani proses Registrasi
    public function register(Request $request)
    {
        // Validasi data inputan pengguna
        $validated = $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:6', // Password minimal 6 karakter
        ]);

        // Membuat pengguna baru di database
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard atau halaman setelah login
        return redirect()->route('dashboard');
    }


    // Menangani proses Login
    public function login(Request $request)
    {
        // Validasi data login
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Debugging log
        \Log::info('Login Attempt', ['email' => $validated['email'], 'password' => $validated['password']]);

        // Menggunakan Auth::attempt untuk mencoba login dengan data yang valid
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // Jika login sukses, redirect ke halaman dashboard
            return redirect()->route('dashboard');
        }

        // Jika login gagal, kembali ke halaman login dengan error
        return back()->withErrors(['email' => 'Kredensial yang dimasukkan tidak valid']);
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');

    }

}
