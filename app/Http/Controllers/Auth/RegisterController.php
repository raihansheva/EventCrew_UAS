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
        $request->validate([
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:6|confirmed',
            'nama_lengkap'      => 'required|string|max:255',
            'no_hp'             => 'required|string|max:25',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'alamat'            => 'required|string',
            'pendidikan'        => 'nullable|string|max:255',
            'keahlian'          => 'nullable|string',
            'pengalaman'        => 'nullable|string',
        ]);

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