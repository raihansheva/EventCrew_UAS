@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/about.css') }}">

@section('content')
    <section class="about-section">
        <div class="area-about">
            <div class="about-header">
                <span class="about-badge">
                    Tentang EventCrew
                </span>
                <h1 class="title-header">
                    Platform Manajemen Volunteer untuk Event
                </h1>
                <p class="desk-header">
                    EventCrew merupakan platform yang membantu penyelenggara mengelola
                    seluruh proses volunteer mulai dari pendaftaran, seleksi,
                    penugasan, hingga evaluasi dalam satu sistem yang terintegrasi.
                </p>
            </div>
            <div class="about-card">
                <div class="card-about-body">
                    <div class="area-text-about">
                        <h3 class="title-about">Apa itu EventCrew?</h3>
                        <p class="desk-about">
                            EventCrew dibuat untuk mempermudah proses pengelolaan
                            volunteer pada berbagai kegiatan seperti seminar,
                            konser, festival, kompetisi, maupun acara sosial.
                        </p>
                        <p class="desk-about">
                            Dengan sistem yang terintegrasi, penyelenggara dapat
                            memantau seluruh proses volunteer secara lebih cepat,
                            sementara volunteer memperoleh informasi mengenai
                            status pendaftaran, penugasan, hingga hasil evaluasi
                            secara transparan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="area-feature">
                <div class="section-title">
                    <h2 class="title-header-F">Fitur Utama</h2>
                    <p class="desk-header-F">
                        Seluruh kebutuhan pengelolaan volunteer tersedia dalam satu platform.
                    </p>
                </div>
                <div class="content-feature">
                    <div class="feature-card">
                        <i class='bx bx-calendar-event'></i>
                        <h5 class="title-feature">Manajemen Event</h5>
                        <p class="desk-feature">
                            Membuat dan mengelola informasi event dengan mudah.
                        </p>
                    </div>
                    <div class="feature-card">
                        <i class='bx bx-group'></i>
                        <h5 class="title-feature">Volunteer</h5>
                        <p class="desk-feature">
                            Mengelola proses pendaftaran volunteer secara praktis.
                        </p>
                    </div>
                    <div class="feature-card">
                        <i class='bx bx-task'></i>
                        <h5 class="title-feature">Penugasan</h5>
                        <p class="desk-feature">
                            Membagikan tugas kepada volunteer berdasarkan divisi.
                        </p>
                    </div>
                    <div class="feature-card">
                        <i class='bx bx-medal'></i>
                        <h5 class="title-feature">Evaluasi</h5>
                        <p class="desk-feature">
                            Memberikan penilaian terhadap kinerja volunteer.
                        </p>
                    </div>
                </div>
            </div>
            <div class="area-role">
                <div class="section-title-role">
                    <h2 class="title-user">Siapa yang Menggunakan?</h2>
                </div>
                <div class="area-card-role">
                    <div class="role-card panitia">
                        <h4>
                            <i class='bx bx-briefcase'></i>
                            Penyelenggara
                        </h4>
                        <ul>
                            <li>Membuat event</li>
                            <li>Mengelola pendaftaran volunteer</li>
                            <li>Memberikan penugasan</li>
                            <li>Melakukan evaluasi volunteer</li>
                        </ul>
                    </div>
                    <div class="role-card volunteer">
                        <h4>
                            <i class='bx bx-user'></i>
                            Volunteer
                        </h4>
                        <ul>
                            <li>Mencari event</li>
                            <li>Mendaftar volunteer</li>
                            <li>Melihat penugasan</li>
                            <li>Melihat hasil evaluasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
