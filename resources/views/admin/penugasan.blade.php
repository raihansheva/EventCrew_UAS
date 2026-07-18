@extends('layouts.mainAdmin')

@section('page-title', 'Penugasan Volunteer')

<link rel="stylesheet" href="{{ asset('style/admin/adminPenugasan.css') }}">
@section('content')
    <div class="admin-section">
        {{-- <div class="section-header">
        </div> --}}
        <div class="section-body">
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Divisi</th>
                                <th>Volunteer</th>
                                <th>Status Penugasan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($penugasan as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->event->nama_event }}</td>
                                    <td>{{ $item->divisi->nama_divisi }}</td>
                                    <td>{{ $item->volunteer->nama_lengkap }}</td>

                                    <td>
                                        @if ($item->penugasan)
                                            <span class="badge bg-success">
                                                Sudah Ditugaskan
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Belum Ditugaskan
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light border-0" data-bs-toggle="dropdown">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                @if (Auth::user()->role == 'panitia')
                                                    @if (!$item->penugasan)
                                                        <li>
                                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#modalTambah{{ $item->id }}">

                                                                <i class='bx bx-task me-2'></i>
                                                                Tambah Penugasan
                                                            </button>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                                <i class='bx bx-edit me-2'></i>
                                                                Edit Penugasan
                                                            </button>
                                                        </li>
                                                    @endif
                                                    @if ($item->penugasan->status_tugas == 'selesai')
                                                        @if ($item->penugasan->evaluasi)
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modalLihatEvaluasi{{ $item->id }}">
                                                                <i class='bx bx-medal me-2'></i>
                                                                Lihat Evaluasi
                                                            </a>
                                                        @else
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modalEvaluasi{{ $item->id }}">
                                                                <i class="bx bx-star me-2"></i>
                                                                Evaluasi
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endif

                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalDetail{{ $item->id }}">

                                                        <i class='bx bx-show me-2'></i>
                                                        Detail
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalTambah{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <form action="{{ route('admin.penugasan.post') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="pendaftaran_id" value="{{ $item->id }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Tambah Penugasan Volunteer
                                                    </h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Volunteer</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->volunteer->nama_lengkap }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Event</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->event->nama_event }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Divisi</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $item->divisi->nama_divisi }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tugas</label>
                                                        <textarea class="form-control" rows="4" name="tugas" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Lokasi Tugas</label>
                                                        <input type="text" class="form-control" name="lokasi_tugas"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Tugas</label>
                                                        <input type="date" class="form-control" name="tanggal_tugas"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jam Mulai</label>
                                                        <input type="time" class="form-control" name="jam_mulai"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Jam Selesai</label>
                                                        <input type="time" class="form-control" name="jam_selesai"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-warning">
                                                        Simpan Penugasan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Detail Penugasan Volunteer
                                                </h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="content-card">
                                                    <div class="area-card">
                                                        <div class="area-card-v">
                                                            <div class="card-v">
                                                                <div class="card-v-header">
                                                                    Informasi Volunteer
                                                                </div>
                                                                <div class="card-v-body">
                                                                    <div class="area-text">
                                                                        <label class="label-v">Nama Volunteer</label>
                                                                        <p class="desk-v">
                                                                            {{ $item->volunteer->nama_lengkap }}</p>
                                                                    </div>
                                                                    <div class="area-text">
                                                                        <label class="label-v">Email</label>
                                                                        <p class="desk-v">
                                                                            {{ $item->volunteer->user->email }}</p>
                                                                    </div>
                                                                    <div class="area-text">
                                                                        <label class="label-v">Motivasi</label>
                                                                        <p class="desk-v">{{ $item->motivasi }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="area-card-e">
                                                            <div class="card-e">
                                                                <div class="card-e-header">
                                                                    Informasi Event
                                                                </div>
                                                                <div class="card-e-body">
                                                                    <div class="area-text">
                                                                        <label class="label-e">Nama Event</label>
                                                                        <p class="desk-e">{{ $item->event->nama_event }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="area-text">
                                                                        <label class="label-e">Divisi</label>
                                                                        <p class="desk-e">{{ $item->divisi->nama_divisi }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="area-text">
                                                                        <label class="label-e">Lokasi Event</label>
                                                                        <p class="desk-e">{{ $item->event->lokasi }}</p>
                                                                    </div>
                                                                    <div class="area-text">
                                                                        <label class="label-e">Tanggal Event</label>
                                                                        <p class="desk-e">
                                                                            {{ \Carbon\Carbon::parse($item->event->tanggal_mulai)->translatedFormat('d F Y') }}
                                                                            -
                                                                            {{ \Carbon\Carbon::parse($item->event->tanggal_selesai)->translatedFormat('d F Y') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-p">
                                                        <div class="card-p-header">
                                                            Informasi Penugasan
                                                        </div>
                                                        <div class="card-p-body">
                                                            @if ($item->penugasan)
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="fw-semibold">
                                                                                Tugas
                                                                            </label>
                                                                            <p>
                                                                                {{ $item->penugasan->tugas }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="fw-semibold">
                                                                                Lokasi Tugas
                                                                            </label>
                                                                            <p>
                                                                                {{ $item->penugasan->lokasi_tugas }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="fw-semibold">
                                                                                Tanggal Bertugas
                                                                            </label>
                                                                            <p>
                                                                                {{ \Carbon\Carbon::parse($item->penugasan->tanggal_mulai_tugas)->translatedFormat('d F Y') }}
                                                                                -
                                                                                {{ \Carbon\Carbon::parse($item->penugasan->tanggal_selesai_tugas)->translatedFormat('d F Y') }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="fw-semibold">
                                                                                Jam Bertugas
                                                                            </label>
                                                                            <p>
                                                                                {{ $item->penugasan->jam_mulai }}
                                                                                -
                                                                                {{ $item->penugasan->jam_selesai }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="fw-semibold">
                                                                                Status Tugas
                                                                            </label>
                                                                            <br>
                                                                            @if ($item->penugasan->status_tugas == 'belum_dimulai')
                                                                                <span class="badge bg-secondary">
                                                                                    Belum Dimulai
                                                                                </span>
                                                                            @elseif($item->penugasan->status_tugas == 'berlangsung')
                                                                                <span class="badge bg-primary">
                                                                                    Berlangsung
                                                                                </span>
                                                                            @else
                                                                                <span class="badge bg-success">
                                                                                    Selesai
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="alert alert-warning mb-0">
                                                                    Volunteer ini belum memiliki penugasan.
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.penugasan.update', $item->penugasan->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Edit Penugasan Volunteer
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Event
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->event->nama_event }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Volunteer
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->volunteer->nama_lengkap }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Divisi
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->divisi->nama_divisi }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">
                                                                Lokasi Tugas
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="lokasi_tugas"
                                                                value="{{ $item->penugasan->lokasi_tugas }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Tugas
                                                        </label>
                                                        <textarea class="form-control" rows="4" name="tugas" required>{{ $item->penugasan->tugas }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">
                                                                Tanggal Tugas
                                                            </label>
                                                            <input type="date" class="form-control"
                                                                name="tanggal_tugas"
                                                                value="{{ $item->penugasan->tanggal_tugas }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">
                                                                Jam Mulai
                                                            </label>
                                                            <input type="time" class="form-control" name="jam_mulai"
                                                                value="{{ $item->penugasan->jam_mulai }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">
                                                                Jam Selesai
                                                            </label>
                                                            <input type="time" class="form-control" name="jam_selesai"
                                                                value="{{ $item->penugasan->jam_selesai }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Status Tugas
                                                        </label>
                                                        <select class="form-select" name="status_tugas">
                                                            <option value="belum_dimulai"
                                                                {{ $item->penugasan->status_tugas == 'belum_dimulai' ? 'selected' : '' }}>
                                                                Belum Dimulai
                                                            </option>
                                                            <option value="berlangsung"
                                                                {{ $item->penugasan->status_tugas == 'berlangsung' ? 'selected' : '' }}>
                                                                Berlangsung
                                                            </option>
                                                            <option value="selesai"
                                                                {{ $item->penugasan->status_tugas == 'selesai' ? 'selected' : '' }}>
                                                                Selesai
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-warning" type="submit">
                                                        Simpan Perubahan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalEvaluasi{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4">
                                            <form action="{{ route('evaluasi.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">
                                                        Evaluasi Volunteer
                                                    </h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="penugasan_id"
                                                        value="{{ $item->penugasan->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Volunteer
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $item->volunteer->nama_lengkap }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Event
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $item->event->nama_event }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Nilai
                                                        </label>
                                                        <select class="form-select" name="nilai" required>
                                                            <option value="">
                                                                -- Pilih Nilai --
                                                            </option>
                                                            <option value="1">
                                                                1 - Sangat Kurang
                                                            </option>
                                                            <option value="2">
                                                                2 - Kurang
                                                            </option>
                                                            <option value="3">
                                                                3 - Cukup
                                                            </option>
                                                            <option value="4">
                                                                4 - Baik
                                                            </option>
                                                            <option value="5">
                                                                5 - Sangat Baik
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Komentar
                                                        </label>
                                                        <textarea class="form-control" name="komentar" rows="4" placeholder="Masukkan komentar..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">
                                                        Simpan Evaluasi
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @if ($item->penugasan->evaluasi)
                                    <div class="modal fade" id="modalLihatEvaluasi{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content rounded-4">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">
                                                        Detail Evaluasi Volunteer
                                                    </h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">
                                                                Volunteer
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->volunteer->nama_lengkap }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">
                                                                Event
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->event->nama_event }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">
                                                                Divisi
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->divisi->nama_divisi }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">
                                                                Dievaluasi Pada
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->penugasan->evaluasi->created_at->translatedFormat('d F Y H:i') }}"
                                                                readonly>
                                                        </div>
                                                        <div class="col-12 mb-4">

                                                            <label class="form-label fw-semibold">
                                                                Hasil Penilaian
                                                            </label>

                                                            @php
                                                                $nilai = $item->penugasan->evaluasi->nilai;
                                                            @endphp

                                                            <div class="border rounded-3 p-4 text-center">

                                                                @if ($nilai == 5)
                                                                    <span class="badge bg-success px-3 py-2">
                                                                        Sangat Baik
                                                                    </span>
                                                                @elseif($nilai == 4)
                                                                    <span class="badge bg-primary px-3 py-2">
                                                                        Baik
                                                                    </span>
                                                                @elseif($nilai == 3)
                                                                    <span class="badge bg-info text-dark px-3 py-2">
                                                                        Cukup
                                                                    </span>
                                                                @elseif($nilai == 2)
                                                                    <span class="badge bg-warning text-dark px-3 py-2">
                                                                        Kurang
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-danger px-3 py-2">
                                                                        Sangat Kurang
                                                                    </span>
                                                                @endif

                                                                <h3 class="fw-bold mt-3 mb-0">
                                                                    {{ $nilai }} / 5
                                                                </h3>

                                                                <small class="text-muted">
                                                                    Nilai Akhir Volunteer
                                                                </small>

                                                            </div>

                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold">
                                                                Komentar
                                                            </label>
                                                            <textarea class="form-control" rows="5" readonly>{{ $item->penugasan->evaluasi->komentar }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada volunteer yang diterima.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-4">
        <div id="successToast" class="toast text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">
                    <i class='bx bx-check-circle me-1'></i>
                    EventCrew
                </strong>
                <small>Berhasil</small>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toastElement = document.getElementById('successToast');
                const toast = new bootstrap.Toast(toastElement, {
                    delay: 3000
                });

                toast.show();
            });
        </script>
    @endif
@endsection
