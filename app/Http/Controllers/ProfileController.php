<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('home.profile', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate(
            [
                'nama' => 'required|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ],
            [
                'nama.required' => 'Nama wajib diisi.',
                'nama.max' => 'Nama maksimal 255 karakter.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
            ]
        );

        if ($request->filled('password')) {

            if (!Hash::check(
                $request->password_sekarang,
                $user->password
            )) {

                return back()->withErrors([
                    'password_sekarang' =>
                        'Password lama salah.'
                ]);
            }

            $request->validate(
                [
                    'password' => 'confirmed|min:8'
                ],
                [
                    'password.confirmed' => 'Konfirmasi password tidak cocok.',
                    'password.min' => 'Password minimal 8 karakter.'
                ]
            );

            $data['password'] =
                Hash::make($request->password);
        }

        $user->update($data);

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }
}
