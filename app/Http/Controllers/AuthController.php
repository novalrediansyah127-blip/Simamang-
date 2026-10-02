<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // ==========================
            // CEK ROLE USER
            // ==========================

            if (Auth::user()->role === 'admin') {

                return redirect()->route('admin.dashboard');

            }

            if (Auth::user()->role === 'operator') {

                return redirect()->route('operator.jurnal.index'); 

            }

            if (Auth::user()->role === 'user') {

                return redirect()->route('monitoring.index');

            }


            // Kalau role tidak dikenali
            Auth::logout();

            return redirect('/login')
                ->withErrors([
                    'email' => 'Role pengguna tidak valid.',
                ]);
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password yang dimasukkan salah.',
            ])
            ->withInput($request->only('email'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // 1. Menampilkan Halaman Tambah Akun Operator
public function indexUser()
{
    // Mengambil semua user yang ber-role 'operator'
    $users = User::where('role', 'operator')->latest()->get();
    return view('admin.users.index', compact('users'));
}

// 2. Memproses Pendaftaran/Pembuatan Akun Operator Baru
public function storeUser(Request $request)
{
    // Validasi Input
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:8',
    ], [
        'name.required'     => 'Nama operator wajib diisi.',
        'email.required'    => 'Email wajib diisi.',
        'email.email'       => 'Format email tidak valid.',
        'email.unique'      => 'Email ini sudah terdaftar.',
        'password.required' => 'Password wajib diisi.',
        'password.min'      => 'Password minimal 8 karakter.',
    ]);

    // Simpan ke Database
    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password), // Password di-hash dengan aman
        'role'     => 'operator',                      // Otomatis diset sebagai operator
    ]);

    return redirect()->back()->with('success', 'Akun Operator berhasil ditambahkan!');
}

    
}