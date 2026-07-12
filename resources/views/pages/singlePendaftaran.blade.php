@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/pendaftaranS.css') }}">

@section('content')
    <section class="section-1">
        <div class="area-pendaftaran">
            <div class="area-header-pendaftaran">
                <h3 class="fw-bold mb-4">
                    Pendaftaran Saya
                </h3>
            </div>
            <div class="area-content-pendaftaran">
                @forelse($pendaftaran as $item)
                    <div class="card-pendaftaran">
                        <div class="card-body">
                            <div class="card-header">
                                <span class="title-header">
                                    {{ $item->event->nama_event }}
                                </span>
                                @if ($item->status_pendaftaran == 'diterima')
                                    <span class="status sukses">
                                        Diterima
                                    </span>
                                @elseif($item->status_pendaftaran == 'ditolak')
                                    <span class="status ditolak">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="status menunggu">
                                        Menunggu
                                    </span>
                                @endif
                            </div>
                            <hr>
                            <div class="card-area-text">
                                <div class="area-text">
                                    <label class="label-text" for="">Divisi :</label>
                                    <span class="span-text">{{ $item->divisi->nama_divisi }}</span>
                                </div>
                                <div class="area-text">
                                    <label class="label-text" for="">Tanggal Daftar :</label>
                                    <span class="span-text">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="area-text">
                                    <label class="label-text" for="">Motivasi :</label>
                                    <span class="span-text">{{ $item->motivasi }}</span>
                                </div>
                            </div>
                            <div class="btn-detail-pendaftaran" data-bs-toggle="modal"
                                data-bs-target="#detail{{ $item->id }}">
                                Lihat Detail
                            </div>
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
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-semibold">Nama Event</label>
                                            <input type="text" class="form-control"
                                                value="{{ $item->event->nama_event }}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-semibold">Divisi</label>
                                            <input type="text" class="form-control"
                                                value="{{ $item->divisi->nama_divisi }}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-semibold">Tanggal Daftar</label>
                                            <input type="text" class="form-control"
                                                value="{{ $item->created_at->format('d F Y') }}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label fw-semibold">Status Pendaftaran</label>
                                            <div>
                                                @if ($item->status_pendaftaran == 'diterima')
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif($item->status_pendaftaran == 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label fw-semibold">Motivasi</label>
                                            <textarea class="form-control" rows="5" readonly>{{ $item->motivasi }}</textarea>
                                        </div>
                                        @if ($item->status_pendaftaran == 'diterima')
                                            <div class="col-md-6 mb-2">
                                                <label class="form-label fw-semibold">Status Penugasan</label>
                                                <div>
                                                    @if ($item->penugasan)
                                                        @if ($item->penugasan->status_tugas == 'berjalan')
                                                            <span class="badge bg-primary">Sedang Berjalan</span>
                                                        @elseif ($item->penugasan->status_tugas == 'selesai')
                                                            <span class="badge bg-success">Selesai</span>
                                                        @else
                                                            <span class="badge bg-secondary">
                                                                {{ ucfirst($item->penugasan->status_tugas) }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-secondary">Belum Ada Penugasan</span>
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
        </div>
    </section>
@endsection
