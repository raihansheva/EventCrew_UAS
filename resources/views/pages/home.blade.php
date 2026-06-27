@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/home.css') }}">

@section('content')
    <section class="section-1">
        <div class="area-kiri">
            <div class="content-kiri">
                <h1 class="title">Temukan Pengalaman, Bangun Relasi, Ciptakan Dampak</h1>
                <p class="description">Bergabunglah sebagai volunteer dalam berbagai acara dan dapatkan pengalaman berharga,
                    keterampilan baru,
                    serta kesempatan memperluas jaringan profesional Anda.</p>
                <a href="/event">
                    <div class="button-event">
                        <p class="button-text">Lihat Event</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="area-kanan">
            <div class="content-kanan">
                <img src="{{ asset('assets/images_hero/imageHero.jpg') }}" class="imageHero" alt="Event Image"
                    srcset="">
            </div>
        </div>
    </section>
    <section class="section-2">
        <div class="area-content-sect-2">
            <div class="content-section">
                <h2 class="section-title">Mengapa Harus Bergabung?</h2>
                <p class="section-description">Sebagai volunteer, Anda akan memiliki kesempatan untuk berkembang, belajar,
                    dan memberikan kontribusi yang berarti kepada komunitas.</p>
            </div>
            <div class="content-card">
                <div class="card-promotion one">

                </div>
                <div class="card-promotion two">

                </div>
                <div class="card-promotion three">

                </div>
                <div class="card-promotion two">

                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="area-content-step">
            <div class="header-step">
                <h2 class="section-title">Cara Bergabung</h2>
                <p class="section-description">Bergabung menjadi volunteer hanya membutuhkan
                    3 langkah sederhana.</p>
            </div>
        </div>
    </section>
@endsection
