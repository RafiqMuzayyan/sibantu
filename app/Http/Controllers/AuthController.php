<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'nik' => 'required|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ],
        [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]
        );

        User::create([
            'nama' => $validated['nama'],
            'nik' => $validated['nik'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'masyarakat',
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi berhasil.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'nik' => 'required',
                'password' => 'required',
            ],
            [
                'nik.required' => 'NIK wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
            elseif (Auth::user()->role === 'manager') {
                return redirect()->route('manager');
            }

            return redirect()->route('home');
        }

        return back()
            ->withErrors([
                'nik' => 'NIK atau password salah.',
            ])
            ->onlyInput('nik');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
