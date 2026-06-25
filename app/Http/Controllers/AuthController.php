<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Salon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // HALAMAN REGISTER
    public function register(Request $request)
    {
        return view('auth.register', [
            'role' => $request->role ?? 'customer'
        ]);
    }


    // PROSES REGISTER
    public function store(Request $request)
{
    $request->validate([

        'name' => 'required',

        'email' => 'required|email|unique:users',

        'password' => 'required|min:6',

        'role' => 'required',

        'nama_salon' => $request->role == 'mitra'
            ? 'required'
            : '',

        'kota' => $request->role == 'mitra'
            ? 'required'
            : '',

        'alamat' => $request->role == 'mitra'
            ? 'required'
            : '',

        'deskripsi' => $request->role == 'mitra'
            ? 'required'
            : '',
    ]);


    $user = User::create([

        'name' => $request->name,

        'email' => $request->email,

        'password' => Hash::make($request->password),

        'role' => $request->role,

    ]);


    if ($request->role == 'mitra') {

        Salon::create([

            'user_id' => $user->id,

            'nama_salon' => $request->nama_salon,

            'kota' => $request->kota,

            'alamat' => $request->alamat,

            'deskripsi' => $request->deskripsi,

        ]);
    }

    return redirect('/login')
        ->with('success', 'Berhasil daftar, silakan login');
}

    // HALAMAN LOGIN
    public function login()
    {
        return view('auth.login');
    }


    // PROSES LOGIN
    public function authenticate(Request $request)
    {
        $credentials = [

            'email' => $request->login_email,

            'password' => $request->login_password

        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // redirect berdasarkan role
            if ($user->role == 'mitra') {

                return redirect('/mitra/dashboard');

            }

            if ($user->role == 'customer') {

                return redirect('/home');

            }

            if ($user->role == 'admin') {

                return redirect('/admin/dashboard');

            }
        }

        return back()->with('error', 'Login gagal');
    }


    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}