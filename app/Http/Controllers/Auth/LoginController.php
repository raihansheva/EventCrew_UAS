<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (empty($request->email) || empty($request->password)) {
            return back()
                ->withErrors([
                    'login_error' => 'Email dan password wajib diisi.'
                ])
                ->withInput();
        }

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin' || $role === 'panitia') {
                return redirect('/dashboard')->with(
                    'toast_success',
                    'Login berhasil! Selamat datang, ' . Auth::user()->email
                );
            }

            return redirect('/')->with(
                'toast_success',
                'Login berhasil! Selamat datang.'
            );
        }

        return back()
            ->withErrors([
                'login_error' => 'Email atau password salah.'
            ])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
