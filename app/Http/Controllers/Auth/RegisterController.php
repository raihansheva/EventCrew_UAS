<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        if (
            empty($request->email) ||
            empty($request->password) ||
            empty($request->password_confirmation) ||
            empty($request->nama_lengkap) ||
            empty($request->no_hp) ||
            empty($request->jenis_kelamin) ||
            empty($request->pendidikan) ||
            empty($request->keahlian) ||
            empty($request->pengalaman) 
        ) {
            return back()
                ->withErrors([
                    'register_error' => 'Semua field wajib diisi.'
                ])
                ->withInput();
        }

        if ($request->password !== $request->password_confirmation) {
            return back()
                ->withErrors([
                    'register_error' => 'Konfirmasi password tidak sesuai.'
                ])
                ->withInput();
        }


        $user = User::create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'volunteer',
        ]);

        Volunteer::create([
            'user_id'       => $user->id,
            'nama_lengkap'  => $request->nama_lengkap,
            'no_hp'         => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'pendidikan'    => $request->pendidikan,
            'keahlian'      => $request->keahlian,
            'pengalaman'    => $request->pengalaman,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
