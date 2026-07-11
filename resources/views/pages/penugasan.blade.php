@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/pendaftaranS.css') }}">

@section('content')
    <section class="section-1">
<div class="container py-5">

    <h3 class="fw-bold mb-4">
        Penugasan Saya
    </h3>

    @forelse($penugasan as $item)

        <div class="card shadow-sm rounded-4 border-0 mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <h4 class="fw-bold mb-1">
                            {{ $item->pendaftaran->event->nama_event }}
                        </h4>

                        <span class="text-muted">
                            {{ $item->pendaftaran->divisi->nama_divisi }}
                        </span>

                    </div>

                    @if($item->status == 'berjalan')

                        <span class="badge bg-primary">
                            Sedang Berjalan
                        </span>

                    @elseif($item->status == 'selesai')

                        <span class="badge bg-success">
                            Selesai
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            {{ ucfirst($item->status) }}
                        </span>

                    @endif

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-6">
                        <small class="text-muted">
                            Tanggal Mulai
                        </small>

                        <h6>
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                        </h6>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">
                            Tanggal Selesai
                        </small>

                        <h6>
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                        </h6>
                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-warning rounded-pill"
                        data-bs-toggle="modal"
                        data-bs-target="#modalDetail{{ $item->id }}">

                        Lihat Detail

                    </button>
                </div>

            </div>

        </div>

        {{-- Modal Detail --}}

        <div class="modal fade"
            id="modalDetail{{ $item->id }}"
            tabindex="-1"
            aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content rounded-4">

                    <div class="modal-header">

                        <h4 class="modal-title fw-bold">
                            Detail Penugasan
                        </h4>

                        <button
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Nama Event
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $item->pendaftaran->event->nama_event }}"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Divisi
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $item->pendaftaran->divisi->nama_divisi }}"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Mulai
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Status Penugasan
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ ucfirst($item->status) }}"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Dibuat Pada
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $item->created_at->translatedFormat('d F Y H:i') }}"
                                    readonly>

                            </div>

                            <div class="col-12 mb-3">

                                <label class="form-label fw-semibold">
                                    Deskripsi Tugas
                                </label>

                                <textarea
                                    class="form-control"
                                    rows="6"
                                    readonly>{{ $item->tugas }}</textarea>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-warning rounded-4">

            Anda belum memiliki penugasan.

        </div>

    @endforelse

</div>
    </section>
@endsection
