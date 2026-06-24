@extends('layouts.main')

@section('content')

<h2>Pendaftaran Volunteer</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="/pendaftaran" method="POST">
    @csrf

    <div>
        <label>Volunteer ID</label>
        <br>
        <input type="number" name="volunteer_id" required>
    </div>

    <br>

    <div>
        <label>Divisi</label>
        <br>
        <input type="text" name="divisi_id" required>
    </div>

    <br>

    <div>
        <label>Deskripsi</label>
        <br>
        <textarea name="deskripsi" rows="5" cols="40"></textarea>
    </div>

    <br>

    <button type="submit">
        Daftar
    </button>
</form>

@endsection