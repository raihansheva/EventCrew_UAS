@extends('layouts.main') {{-- kalau ada layout utama --}}

@section('content')
    <h2>Login</h2>
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
@endsection
