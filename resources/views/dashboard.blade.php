@extends('layouts.main')

@section('content')
    <h2>Selamat datang, {{ Auth::user()->email }}</h2>
    <p>Role kamu: {{ Auth::user()->role }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
