@extends('layouts.mainAdmin')

<link rel="stylesheet" href="{{ asset('style/admin/adminEvent.css') }}">
@section('page-title', 'Event')

@section('content')

    {{-- @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif --}}

    <div class="admin-section">
        <div class="section-header">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Data
            </button>
        </div>

        <div class="section-body">
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table mb-0 table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status Event</th>
                                <th>Status Verifikasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $i => $event)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $event->nama_event }}</td>
                                    <td>{{ $event->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $event->lokasi }}</td>
                                    <td>{{ $event->tanggal_mulai }}</td>
                                    <td>{{ $event->tanggal_selesai }}</td>
                                    <td>
                                        @if ($event->status_event == 'persiapan')
                                            <span class="badge bg-secondary">
                                            @elseif($event->status_event == 'open')
                                                <span class="badge bg-info text-dark">
                                                @elseif($event->status_event == 'seleksi')
                                                    <span class="badge bg-warning">
                                                    @elseif($event->status_event == 'berlangsung')
                                                        <span class="badge bg-primary">
                                                        @elseif($event->status_event == 'selesai')
                                                            <span class="badge bg-success">
                                        @endif
                                        {{ $event->status_event }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($event->status_verifikasi == 'ditolak')
                                            <span class="badge bg-danger">
                                            @elseif ($event->status_verifikasi == 'disetujui')
                                                <span class="badge bg-success">
                                                @else
                                                    <span class="badge bg-secondary">
                                        @endif
                                        {{ $event->status_verifikasi }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropup">
                                            <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <div class="area-menu-drop">
                                                    <li>
                                                        <button class="dropdown-item drop-detail d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail{{ $event->id }}">
                                                            <i class='bx bx-show me-2'></i>
                                                            Detail
                                                        </button>
                                                    </li>
                                                    @if (Auth::user()->role == 'admin')
                                                        @if ($event->status_verifikasi !== 'disetujui')
                                                            <li>
                                                                <button class="dropdown-item d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalVerify{{ $event->id }}">
                                                                    <i class='bx bx-check-circle me-2'></i>
                                                                    Verifikasi
                                                                </button>
                                                            </li>
                                                        @endif
                                                    @endif
                                                    <li>
                                                        <button class="dropdown-item drop-edit d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEdit{{ $event->id }}">
                                                            <i class='bx bx-edit-alt me-2'></i>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class="dropdown-item text-danger drop-hapus d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalHapus{{ $event->id }}">
                                                            <i class="bx bx-trash me-2"></i>
                                                            Hapus
                                                        </button>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalEdit{{ $event->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Event</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="/data-event/{{ $event->id }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf @method('PUT')
                                                <div class="modal-body">
                                                    <div class="area-content-input">
                                                        <div class="area-kiri">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Event</label>
                                                                <input type="text" name="nama_event" class="form-control"
                                                                    value="{{ $event->nama_event }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kategori</label>
                                                                <select name="kategori_id" class="form-select" required>
                                                                    @foreach ($kategoris as $k)
                                                                        <option value="{{ $k->id }}"
                                                                            {{ $event->kategori_id == $k->id ? 'selected' : '' }}>
                                                                            {{ $k->nama_kategori }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Lokasi</label>
                                                                <input type="text" name="lokasi" class="form-control"
                                                                    value="{{ $event->lokasi }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea name="deskripsi" class="form-control" rows="3">{{ $event->deskripsi }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="area-kanan">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label class="form-label">Tanggal Mulai</label>
                                                                    <input type="date" name="tanggal_mulai"
                                                                        class="form-control"
                                                                        value="{{ $event->tanggal_mulai }}" required>
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label class="form-label">Tanggal Selesai</label>
                                                                    <input type="date" name="tanggal_selesai"
                                                                        class="form-control"
                                                                        value="{{ $event->tanggal_selesai }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Poster (kosongkan jika tidak
                                                                    diubah)</label>
                                                                <input type="file" name="poster" class="form-control"
                                                                    accept="image/*">
                                                                {{-- @if ($event->poster)
                                        <img src="{{ asset('storage/' . $event->poster) }}" class="mt-2"
                                            width="80">
                                    @endif --}}
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Status Event</label>
                                                                <select name="status_event" class="form-select" required>
                                                                    @foreach (['persiapan', 'open', 'seleksi', 'berlangsung', 'selesai'] as $s)
                                                                        <option value="{{ $s }}"
                                                                            {{ $event->status_event == $s ? 'selected' : '' }}>
                                                                            {{ ucfirst($s) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalHapus{{ $event->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Event</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-input text-center">
                                                    <label for="">Apakah Anda yakin ingin menghapus event
                                                        ini?</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="/data-event/{{ $event->id }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalVerify{{ $event->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Verifikasi Event</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i class='bx bx-check-shield text-warning' style="font-size:70px;"></i>
                                                <h5 class="mt-3">{{ $event->nama_event }}</h5>
                                                <p class="text-muted">
                                                    Silakan pilih apakah event ini akan disetujui atau ditolak.
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalTolak{{ $event->id }}">
                                                    Tolak
                                                </button>
                                                <form action="{{ route('admin.event.verifikasi', $event->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_verifikasi" value="disetujui">
                                                    <button class="btn btn-success">
                                                        Setujui
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalTolak{{ $event->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.event.verifikasi', $event->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status_verifikasi" value="ditolak">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Alasan Penolakan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">
                                                        Masukkan alasan penolakan
                                                    </label>
                                                    <textarea name="alasan_penolakan" class="form-control" rows="4" required
                                                        placeholder="Contoh: Poster kurang jelas atau data event belum lengkap."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal" data-bs-toggle="modal"
                                                        data-bs-target="#modalVerify{{ $event->id }}">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-danger">
                                                        Kirim Penolakan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalDetail{{ $event->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Event</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-detail">
                                                    <div class="content-kiri">
                                                        <img class="img-event"
                                                            src="{{ asset('storage/' . $event->poster) }}"
                                                            alt="Poster Event" class="img-fluid">
                                                    </div>
                                                    <div class="content-kanan">
                                                        <div class="area-kiri-detail">
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-calendar-event'></i> Nama
                                                                    Event</label>
                                                                <span class="value-event">{{ $event->nama_event }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-map text-danger'></i> Lokasi</label>
                                                                <span class="value-event">{{ $event->lokasi }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-calendar-event'></i>
                                                                    Tanggal
                                                                    Mulai</label>
                                                                <span
                                                                    class="value-event">{{ $event->tanggal_mulai }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-calendar-check'></i>
                                                                    Tanggal
                                                                    Selesai</label>
                                                                <span
                                                                    class="value-event">{{ $event->tanggal_selesai }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="area-kanan-detail">
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-category'></i>
                                                                    Kategori</label>
                                                                <span
                                                                    class="value-event">{{ $event->kategori->nama_kategori ?? '-' }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-flag'></i> Status</label>
                                                                <span
                                                                    class="value-event">{{ $event->status_event ?? '-' }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-badge-check text-info'></i> Status
                                                                    Verifikasi</label>
                                                                @if ($event->status_verifikasi == 'disetujui')
                                                                    <span class="value-event"
                                                                        style="color: rgb(1, 209, 1); font-weight: bold;">
                                                                    @elseif ($event->status_verifikasi == 'ditolak')
                                                                        <span class="value-event"
                                                                            style="color: red; font-weight: bold;">
                                                                        @else
                                                                            <span class="value-event"
                                                                                style="color: gray; font-weight: bold;">
                                                                @endif
                                                                {{ $event->status_verifikasi ?? '-' }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-detail'></i>
                                                                    Deskripsi</label>
                                                                <span class="value-event">{{ $event->deskripsi }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada data event.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/data-event" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="area-content-input">
                            <div class="area-kiri">
                                <div class="mb-3">
                                    <label class="form-label">Nama Event</label>
                                    <input type="text" name="nama_event" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="kategori_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategoris as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="area-kanan">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Poster</label>
                                    <input type="file" name="poster" class="form-control" accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status Event</label>
                                    <select name="status_event" class="form-select" required>
                                        <option value="">Pilih Status</option>
                                        <option value="persiapan">Persiapan</option>
                                        <option value="open">Open</option>
                                        <option value="seleksi">Seleksi</option>
                                        <option value="berlangsung">Berlangsung</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
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
