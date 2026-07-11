@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/pendaftaranS.css') }}">

@section('content')
    <section class="section-1">
        <div class="container py-5">

            <h3 class="fw-bold mb-4">
                Pendaftaran Saya
            </h3>

            @forelse($pendaftaran as $item)
                <div class="card shadow-sm rounded-4 border-0 mb-4">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <h5 class="fw-bold">
                                {{ $item->event->nama_event }}
                            </h5>

                            @if ($item->status_pendaftaran == 'diterima')
                                <span class="badge bg-success">
                                    Diterima
                                </span>
                            @elseif($item->status_pendaftaran == 'ditolak')
                                <span class="badge bg-danger">
                                    Ditolak
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    Menunggu
                                </span>
                            @endif

                        </div>

                        <hr>

                        <p>
                            <strong>Divisi :</strong>
                            {{ $item->divisi->nama_divisi }}
                        </p>

                        <p>
                            <strong>Tanggal Daftar :</strong>
                            {{ $item->created_at->format('d M Y') }}
                        </p>

                        <p>
                            <strong>Motivasi :</strong><br>
                            {{ $item->motivasi }}
                        </p>

                        <button class="btn btn-warning rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#detail{{ $item->id }}">
                            Lihat Detail
                        </button>

                    </div>

                </div>
                <div class="modal fade" id="detail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header">
                                <h4 class="modal-title fw-bold">
                                    Detail Pendaftaran
                                </h4>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-semibold text-secondary">
                                            Nama Event
                                        </label>
                                        <div class="form-control">
                                            {{ $item->event->nama_event }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-semibold text-secondary">
                                            Divisi
                                        </label>
                                        <div class="form-control">
                                            {{ $item->divisi->nama_divisi }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-semibold text-secondary">
                                            Tanggal Daftar
                                        </label>
                                        <div class="form-control">
                                            {{ $item->created_at->format('d F Y') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-semibold text-secondary">
                                            Status Pendaftaran
                                        </label>
                                        <div class="form-control">
                                            @if ($item->status_pendaftaran == 'diterima')
                                                <span class="badge bg-success">
                                                    Diterima
                                                </span>
                                            @elseif($item->status_pendaftaran == 'ditolak')
                                                <span class="badge bg-danger">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    Menunggu
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="fw-semibold text-secondary">
                                            Motivasi
                                        </label>
                                        <textarea class="form-control" rows="5" readonly>{{ $item->motivasi }}</textarea>
                                    </div>
                                    @if ($item->status_pendaftaran == 'diterima')
                                        <div class="col-md-6 mb-3">
                                            <label class="fw-semibold text-secondary">
                                                Status Penugasan
                                            </label>
                                            <div class="form-control">
                                                @if ($item->penugasan)
                                                    @switch($item->penugasan->status)
                                                        @case('berjalan')
                                                            <span class="badge bg-primary">
                                                                Sedang Berjalan
                                                            </span>
                                                        @break
                                                        @case('selesai')
                                                            <span class="badge bg-success">
                                                                Selesai
                                                            </span>
                                                        @break
                                                        @default
                                                            <span class="badge bg-secondary">
                                                                {{ ucfirst($item->penugasan->status) }}
                                                            </span>
                                                    @endswitch
                                                @else
                                                    <span class="badge bg-secondary">
                                                        Belum Ditugaskan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                    <div class="alert alert-warning rounded-4">
                        Anda belum pernah mendaftar volunteer.
                    </div>
                @endforelse

            </div>
        </section>
    @endsection
