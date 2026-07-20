@extends('layouts.mainAdmin')

@section('page-title', 'Divisi Event')

@section('content')
    <div class="admin-section">
        @if (Auth::user()->role == 'panitia' &&
                Auth::user()->penyelenggara &&
                Auth::user()->penyelenggara->status_verifikasi == 'terverifikasi')
            <div class="section-header d-flex justify-content-between align-items-center">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addModal">
                    Tambah Data
                </button>

                <button type="button" class="btn btn-sm btn-dark rounded-circle d-flex justify-content-between align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modalInfoDivisi" style="width:38px;height:38px;">
                    <i class='bx bx-info-circle fs-5'></i>
                </button>
            </div>
        @endif
        <div class="modal fade" id="modalInfoDivisi" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class='bx bx-info-circle me-2'></i>
                            Informasi Halaman Divisi
                        </h5>
                        <button class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            Halaman ini digunakan untuk mengelola divisi pada setiap event yang Anda selenggarakan.
                        </div>
                        <ul class="mb-0">
                            <li>Setiap divisi dibuat khusus untuk <strong>event milik Anda</strong>.</li>
                            <li>Nama divisi harus sesuai dengan kebutuhan pelaksanaan event, seperti Registrasi,
                                Dokumentasi, Konsumsi, Keamanan, Liaison Officer (LO), dan lainnya.</li>
                            <li>Divisi yang telah dibuat akan ditampilkan pada formulir pendaftaran volunteer sehingga
                                peserta dapat memilih divisi yang diinginkan.</li>
                            <li>Panitia dapat mengubah atau menghapus divisi selama divisi tersebut belum digunakan pada
                                proses penugasan volunteer.</li>
                            <li>Pastikan jumlah divisi sesuai dengan kebutuhan agar proses penempatan volunteer menjadi
                                lebih mudah.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="70">No</th>
                                <th>Nama Event</th>
                                <th>Nama Divisi</th>
                                <th>Deskripsi</th>
                                <th>Kuota Volunteer</th>
                                @if (Auth::user()->role == 'panitia' &&
                                        Auth::user()->penyelenggara &&
                                        Auth::user()->penyelenggara->status_verifikasi == 'terverifikasi')
                                    <th width="180" class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($divisi as $i => $d)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>{{ $d->event->nama_event }}</td>
                                    <td>{{ $d->nama_divisi }}</td>
                                    <td>{{ $d->deskripsi }}</td>
                                    <td>{{ $d->kuota_volunteer }}</td>
                                    @if (Auth::user()->role == 'panitia' &&
                                            Auth::user()->penyelenggara &&
                                            Auth::user()->penyelenggara->status_verifikasi == 'terverifikasi')
                                        <td class="text-center">
                                            <div class="dropup">
                                                <button class="btn btn-light border-0" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-dots-vertical-rounded'></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                                    <div class="area-menu-drop">
                                                        @if (Auth::user()->role == 'panitia')
                                                            <li>
                                                                <button
                                                                    class="dropdown-item drop-edit d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editModal{{ $d->id }}">
                                                                    <i class='bx bx-edit-alt me-2'></i>
                                                                    Edit
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button
                                                                    class="dropdown-item text-danger drop-hapus d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalHapus{{ $d->id }}">
                                                                    <i class="bx bx-trash me-2"></i>
                                                                    Hapus
                                                                </button>
                                                            </li>
                                                        @endif
                                                    </div>
                                                </ul>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1">
                                    <div class="modal-dialog p-2">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Divisi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.divisi.update', $d->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Event</label>
                                                        <select name="event_id" class="form-select" required>
                                                            <option value="">Pilih Event</option>
                                                            @foreach ($event as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $d->event_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama_event }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Divisi</label>
                                                        <input type="text" name="nama_divisi" class="form-control"
                                                            value="{{ $d->nama_divisi }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3">{{ $d->deskripsi }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kuota Volunteer</label>
                                                        <input type="number" name="kuota_volunteer" class="form-control"
                                                            value="{{ $d->kuota_volunteer }}" min="1" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-warning">
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalHapus{{ $d->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Kategori</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-input text-center">
                                                    <label for="">Apakah Anda yakin ingin menghapus kategori
                                                        ini?</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.divisi.destroy', $d->id) }}"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data kategori event
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.divisi.post') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Tambah Divisi Event
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Event</label>
                            <select name="event_id" class="form-select" required>
                                <option value="">Pilih Status</option>
                                @foreach ($event as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_event }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Divisi</label>
                            <input type="text" name="nama_divisi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kuota Volunteer</label>
                            <input type="number" name="kuota_volunteer" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button class="btn btn-warning">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@if (session('success'))
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
@if (session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-4">
        <div id="errorToast" class="toast text-bg-danger border-0" role="alert">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">
                    <i class='bx bx-error-circle me-1'></i>
                    EventCrew
                </strong>
                <small>Gagal</small>
            </div>
            {{-- <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button> --}}
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toastError = new bootstrap.Toast(document.getElementById('errorToast'), {
                delay: 4000
            });
            toastError.show();
        });
    </script>
@endif
@if (session('openDeleteModal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(
                document.getElementById('modalHapus{{ session('openDeleteModal') }}')
            );

            modal.show();
        });
    </script>
@endif
