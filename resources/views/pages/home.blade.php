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
                    <div class="area-header-card-promo">
                    </div>
                    <div class="area-text-card">
                        <h4 class="title-promo">Kembangkan Diri</h4>
                        <p class="desc-promo">Tingkatkan kemampuan komunikasi, kepemimpinan, dan kerja sama tim melalui pengalaman langsung di
                            berbagai kegiatan.</p>
                    </div>
                </div>
                <div class="card-promotion two">
                    <div class="area-header-card-promo">
                    </div>
                    <div class="area-text-card">
                        <h4 class="title-promo">Bangun Relasi</h4>
                        <p class="desc-promo">Bertemu dengan volunteer lain, komunitas, dan organisasi yang memiliki tujuan yang sama.</p>
                    </div>
                </div>
                <div class="card-promotion three">
                    <div class="area-header-card-promo">
                    </div>
                    <div class="area-text-card">
                        <h4 class="title-promo">Berikan Dampak</h4>
                        <p class="desc-promo">Kontribusikan waktu dan kemampuanmu untuk membantu masyarakat serta menciptakan perubahan yang berarti.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="area-content-step">
            <div class="header-step">
                <h2 class="section-title">Cara Bergabung</h2>
                <p class="section-description">Bergabung menjadi volunteer hanya membutuhkan
                    4 langkah sederhana.</p>
            </div>
            <div class="content-step">
                <div class="step-container">
                    <div class="step-line"></div>
                    <div class="step-item">
                        <div class="step-circle">1</div>
                        <div class="area-desc">
                            <h3 class="step-heading">Cari Event</h3>
                            <p class="step-text">Temukan event sosial yang sesuai dengan minatmu.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">2</div>
                        <div class="area-desc">
                            <h3 class="step-heading">Login / Registrasi</h3>
                            <p class="step-text">Masuk ke akun atau buat akun baru untuk mulai mendaftar.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="area-desc">
                            <h3 class="step-heading">Daftar Volunteer</h3>
                            <p class="step-text">Isi formulir pendaftaran dan tunggu proses verifikasi via email.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">4</div>
                        <div class="area-desc">
                            <h3 class="step-heading">Ikuti Event</h3>
                            <p class="step-text">Datang sesuai jadwal dan berkontribusi bersama komunitas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
