@extends('layouts.main')
<link rel="stylesheet" href="{{ asset('style/event.css') }}">
@section('content')
    <div class="area-event">
        <div class="header-event">
            <h1 class="title-event">Event</h1>
            <p>
                Temukan berbagai event menarik dan kesempatan untuk berkontribusi sebagai volunteer.
                Bergabunglah dalam kegiatan inspiratif, kembangkan pengalaman baru, dan menjadi bagian
                dari berbagai acara kreatif bersama komunitas.
            </p>
        </div>
        <div class="area-content-event">
            <div class="content-event">
                @foreach ($event as $item)
                    <div class="card-event">
                        <div class="header-card">
                            <img class="imgCard" src="/storage/{{ $item->poster }}" alt="{{ $item->nama_event }}">
                        </div>
                        <div class="body-card">
                            <span class="badge-event">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                            <h3 class="title-card">
                                {{ $item->nama_event }}
                            </h3>
                            <div class="info-event">
                                <div class="info-item">
                                    <i class='bx bx-map'></i>
                                    <span>{{ $item->lokasi }}</span>
                                </div>
                                <div class="info-item">
                                    <i class='bx bx-calendar'></i>
                                    <span>
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            @if (Auth::check())
                                <a href="/pendaftaran/{{ $item->id }}" class="btn-detail">
                                    Lihat Detail
                                </a>
                            @else
                                <a href="#" class="btn-detail" onclick="return false;" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Anda Harus Login / Register Dulu">
                                    Lihat Detail
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
