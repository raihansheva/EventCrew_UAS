@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/home.css') }}">

@section('content')
    <section>
        <div class="area-kiri">
            <div class="content-kiri">
                <h1 class="title">Temukan Pengalaman, Bangun Relasi, Ciptakan Dampak</h1>
                <p class="description">Bergabunglah sebagai volunteer dalam berbagai acara dan dapatkan pengalaman berharga, keterampilan baru,
                    serta kesempatan memperluas jaringan profesional Anda.</p>
                <a href="/event">
                    <div class="button-event">
                        <p>Lihat Event</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="area-kanan">
            <div class="content-kanan">
                gambar
            </div>
        </div>
    </section>
@endsection
