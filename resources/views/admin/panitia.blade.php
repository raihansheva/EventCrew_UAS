@extends('layouts.mainAdmin')

@section('page-title', 'Panitia')

<link rel="stylesheet" href="{{ asset('style/admin/adminPanitia.css') }}">
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
                                <th>Nama Penyelenggara</th>
                                <th>Nama Penanggung Jawab</th>
                                <th>No HP</th>
                                {{-- <th>Alamat</th>
                                <th>Deskripsi</th> --}}
                                <th>Status Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($panitia as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->nama_penyelenggara }}</td>
                                    <td>{{ $user->nama_penanggung_jawab }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    {{-- <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->deskripsi }}</td> --}}
                                    <td>{{ $user->status_verifikasi }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <div class="area-menu-drop">
                                                    @if ($user->status_verifikasi !== 'terverifikasi')
                                                        <li>
                                                            <button class="dropdown-item d-flex align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalVerify{{ $user->id }}">
                                                                <i class='bx bx-check-circle me-2'></i>
                                                                Verifikasi
                                                            </button>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <button class="dropdown-item drop-detail d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail{{ $user->id }}">
                                                            <i class='bx bx-show me-2'></i>
                                                            Detail
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item drop-edit d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $user->id }}">
                                                            <i class='bx bx-edit-alt me-2'></i>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class="dropdown-item text-danger drop-hapus d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalHapus{{ $user->id }}">
                                                            <i class="bx bx-trash me-2"></i>
                                                            Hapus
                                                        </button>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalHapus{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Penyelenggara</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-input text-center">
                                                    <label for="">Apakah Anda yakin ingin menghapus penyelenggara
                                                        ini?</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.panitia.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalDetail{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg modal-custom">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Penyelenggara</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-detail">
                                                    <div class="content-kiri">
                                                        <div class="area-label">
                                                            <label class="label-event" for=""><i
                                                                    class='bx bx-envelope'></i> Email</label>
                                                            <span class="value-event">{{ $user->user->email }}</span>
                                                        </div>
                                                        <div class="area-label">
                                                            <label class="label-event" for=""><i
                                                                    class='bx bx-lock-alt'></i> Password</label>
                                                            <span class="value-event">••••••••</span>
                                                        </div>
                                                        <div class="area-label">
                                                            <label class="label-event" for=""><i
                                                                    class='bx bx-id-card'></i>
                                                                Role</label>
                                                            <span class="value-event">{{ $user->user->role }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="content-kanan">
                                                        <div class="area-kiri-detail">
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-user'></i> Nama
                                                                    Penyelenggara</label>
                                                                <span
                                                                    class="value-event">{{ $user->nama_penyelenggara }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-phone'a></i> Nama Penanggung Jawab
                                                                </label>
                                                                <span
                                                                    class="value-event">{{ $user->nama_penanggung_jawab }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-male-female'></i>
                                                                    Nomer Handphone</label>
                                                                <span class="value-event">{{ $user->no_hp }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-map text-danger'></i>
                                                                    Alamat</label>
                                                                <span class="value-event">{{ $user->alamat }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="area-kanan-detail">
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-brain'></i>
                                                                    Deskripsi</label>
                                                                <span
                                                                    class="value-event">{{ $user->deskripsi ?? '-' }}</span>
                                                            </div>

                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-badge-check text-info'></i> Status
                                                                    Verifikasi</label>
                                                                @if ($user->status_verifikasi == 'terverifikasi')
                                                                    <span class="value-event"
                                                                        style="color: rgb(1, 209, 1); font-weight: bold;">
                                                                    @elseif ($user->status_verifikasi == 'ditolak')
                                                                        <span class="value-event"
                                                                            style="color: red; font-weight: bold;">
                                                                        @else
                                                                            <span class="value-event"
                                                                                style="color: gray; font-weight: bold;">
                                                                @endif
                                                                {{ $user->status_verifikasi ?? '-' }}</span>
                                                            </div>
                                                            {{-- <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-detail'></i>
                                                                    Deskripsi</label>
                                                                <span class="value-event">{{ $event->deskripsi }}</span>
                                                            </div>  --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-body p-2">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Event</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/data-panitia/{{ $user->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="area-content-input">
                                                            <div class="area-kiri">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Penyelenggara</label>
                                                                    <input type="text" name="nama_penyelenggara"
                                                                        class="form-control"
                                                                        value="{{ $user->nama_penyelenggara }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Penanggung Jawab</label>
                                                                    <input type="text" name="nama_penanggung_jawab"
                                                                        class="form-control"
                                                                        value="{{ $user->nama_penanggung_jawab }}"
                                                                        required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nomer Handphone</label>
                                                                    <input type="text" name="no_hp"
                                                                        class="form-control" value="{{ $user->no_hp }}"
                                                                        required>
                                                                </div>

                                                            </div>
                                                            <div class="area-kanan">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Alamat</label>
                                                                    <textarea name="alamat" class="form-control" rows="3">{{ $user->alamat }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Deskripsi</label>
                                                                    <textarea name="deskripsi" class="form-control" rows="3">{{ $user->deskripsi }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Status Verifikasi</label>
                                                                    <input type="text" name="status_verifikasi"
                                                                        class="form-control"
                                                                        value="{{ $user->status_verifikasi }}" readonly>
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
                                </div>
                                <div class="modal fade" id="modalVerify{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Verifikasi Penyelenggara</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i class='bx bx-check-shield text-warning' style="font-size:70px;"></i>
                                                <h5 class="mt-3">{{ $user->nama_penyelenggara }}</h5>
                                                <p class="text-muted">
                                                    Silakan pilih apakah penyelenggara ini akan diverifikasi atau ditolak.
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <form action="{{ route('admin.panitia.verifikasi', $user->id) }}"
                                                    method="POST" class="me-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_verifikasi" value="ditolak">

                                                    <button type="submit" class="btn btn-danger">
                                                        Tolak
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.panitia.verifikasi', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_verifikasi" value="terverifikasi">

                                                    <button type="submit" class="btn btn-success">
                                                        Setujui
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada data volunteer
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
