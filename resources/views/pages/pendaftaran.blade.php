@extends('layouts.main')
<link rel="stylesheet" href="{{ asset('style/pendaftaran.css') }}">
@section('content')
    <div class="area-content-pendaftaran">
        <div class="content-pendaftaran">
            <div class="area-kiri">
                <img class="imgPoster" src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->nama_event }}">
            </div>
            <div class="area-kanan">
                <div class="header-detail">
                    <span class="badge-event">
                        {{ $event->kategori->nama_kategori }}
                    </span>
                    <h1 class="nama-event">
                        {{ $event->nama_event }}
                    </h1>
                    <div class="info-event">
                        <div class="item-info">
                            <i class='bx bx-map'></i>
                            {{ $event->lokasi }}
                        </div>
                        <div class="item-info">
                            <i class='bx bx-calendar'></i>
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }}
                        </div>
                        <div class="item-info">
                            <i class='bx bx-user'></i>
                            {{ $event->panitia->nama_panitia }}
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <h3>Tentang Event</h3>
                    <p>
                        {{ $event->deskripsi }}
                    </p>
                </div>
                <div class="section-detail">
                    <h3>Persyaratan Volunteer</h3>
                    <ul class="persyaratan">
                        {{-- @foreach (explode("\n", $event->persyaratan) as $item)
                            @if (trim($item) != '')
                                <li>{{ $item }}</li>
                            @endif
                        @endforeach --}}
                    </ul>
                </div>
                <!-- Divisi -->
                <div class="section-detail">
                    <h3 class="title-divisi">Divisi yang Dibutuhkan</h3>
                    <div class="area-divisi">
                        @foreach ($event->divisiVolunteer as $divisi)
                            <div class="card-divisi">
                                <div class="content-divisi">
                                    <h4 class="nama-divisi">{{ $divisi->nama_divisi }}</h4>
                                    <p class="desk-divisi">
                                        {{ $divisi->deskripsi }}
                                    </p>
                                    <span class="kuota-divisi">
                                        Kuota :
                                        {{ $divisi->kuota_volunteer }}
                                        Orang
                                    </span>
                                </div>
                                <button class="btn-daftar" data-bs-toggle="modal"
                                    data-bs-target="#modalDaftar{{ $divisi->id }}">
                                    Daftar
                                </button>
                                <div class="modal fade" id="modalDaftar{{ $divisi->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        @csrf
                                        <input type="hidden" name="divisi_id" value="{{ $divisi->id }}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Form Pendaftaran Volunteer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Event
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $event->nama_event }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Divisi
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $divisi->nama_divisi }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Nama Volunteer
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ Auth::user()->volunteer->nama_lengkap }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Email
                                                            </label>
                                                            <input type="email" class="form-control"
                                                                value="{{ Auth::user()->email }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Motivasi Mendaftar
                                                        </label>
                                                        <textarea name="deskripsi" rows="5" class="form-control"
                                                            placeholder="Ceritakan alasan Anda ingin bergabung menjadi volunteer..." required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                        type="button">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-primary" type="submit">
                                                        Daftar Sekarang
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
