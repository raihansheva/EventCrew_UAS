@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/penugasan.css') }}">

@section('content')
    <section class="section-1">
        <div class="area-penugasan">
            <div class="area-header-penugasan">
                <h3 class="fw-bold mb-4">
                    Penugasan Saya
                </h3>
            </div>
            <div class="area-content-penugasan">
                @forelse($penugasan as $item)
                    <div class="card-penugasan">
                        <div class="card-body">
                            <div class="card-header">
                                <div>
                                    <h4 class="fw-bold mb-1">
                                        {{ $item->pendaftaran->event->nama_event }}
                                    </h4>
                                    <span class="text-muted">
                                        {{ $item->pendaftaran->divisi->nama_divisi }}
                                    </span>
                                </div>
                                @if ($item->status_tugas == 'berjalan')
                                    <span class="status berjalan">
                                        Sedang Berjalan
                                    </span>
                                @elseif($item->status_tugas == 'selesai')
                                    <span class="status selesai">
                                        Selesai
                                    </span>
                                @else
                                    <span class="status default">
                                        {{ ucfirst($item->status_tugas) }}
                                    </span>
                                @endif
                            </div>
                            <hr>
                            <div class="card-area-text">
                                <div class="area-text">
                                    <label class="label-text">Lokasi</label>
                                    <span class="span-text">
                                        {{ $item->lokasi_tugas }}
                                    </span>
                                </div>
                                <div class="area-date">
                                    <div class="area-text">
                                        <label class="label-text">Tanggal Tugas</label>
                                        <span class="span-text">
                                            {{ \Carbon\Carbon::parse($item->tanggal_tugas)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                    <div class="area-text">
                                        <label class="label-text">Jam Penugasan</label>
                                        <span class="span-text">
                                            {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="btn-detail-penugasan" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                    Lihat Detail
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold">
                                        Detail Penugasan
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Event</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->pendaftaran->event->nama_event }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Divisi</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->pendaftaran->divisi->nama_divisi }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Tugas</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->tanggal_tugas)->translatedFormat('d F Y') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi Tugas</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->lokasi_tugas }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Mulai</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Selesai</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Durasi</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Penugasan</label>

                                            <div>
                                                @if ($item->status_tugas == 'berjalan')
                                                    <span class="badge bg-primary">
                                                        Sedang Berjalan
                                                    </span>
                                                @elseif ($item->status_tugas == 'selesai')
                                                    <span class="badge bg-success">
                                                        Selesai
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst($item->status_tugas) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi Tugas</label>

                                                <textarea class="form-control" rows="5" readonly>{{ $item->tugas }}</textarea>
                                            </div>
                                        </div>
                                    </div>
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
        </div>
    </section>
@endsection
