@extends('layouts.mainAdmin')

@section('page-title', 'Pendaftaran')

<link rel="stylesheet" href="{{ asset('style/admin/adminPendaftaran.css') }}">
@section('content')
    <div class="admin-section">
        {{-- <div class="section-header">
        </div> --}}
        @if (Auth::user()->role == "panitia")
            <div class="section-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-dark rounded-circle" data-bs-toggle="modal"
                    data-bs-target="#modalInfoPendaftaran" style="width:38px;height:38px;">
                    <i class='bx bx-info-circle fs-5'></i>
                </button>
            </div>
        @endif
        <div class="modal fade" id="modalInfoPendaftaran" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>
                            Informasi Halaman
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-light border mb-0">
                            <h6 class="fw-bold mb-3">
                                Panduan Pengelolaan Pendaftaran
                            </h6>
                            <ul class="mb-0 ps-3">
                                <li>
                                    Halaman ini menampilkan seluruh volunteer yang telah
                                    mendaftar pada event Anda.
                                </li>
                                <li>
                                    Klik menu <strong>Aksi</strong> untuk melihat detail
                                    pendaftaran volunteer.
                                </li>
                                <li>
                                    Panitia dapat menerima atau menolak pendaftaran
                                    berdasarkan data diri dan motivasi volunteer.
                                </li>
                                <li>
                                    Volunteer yang telah <strong>diterima</strong>
                                    dapat diberikan penugasan pada halaman
                                    <strong>Penugasan Volunteer</strong>.
                                </li>
                                <li>
                                    Volunteer yang sudah memiliki penugasan tidak dapat
                                    didaftarkan ulang.
                                </li>
                            </ul>
                        </div>
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
                                <th>No</th>
                                <th>Nama Event</th>
                                <th>Divisi</th>
                                <th>Nama Volunteer</th>
                                <th>Motivasi</th>
                                <th>Status Pendaftaran</th>
                                @if (
                                        Auth::user()->role == 'panitia' &&
                                        Auth::user()->penyelenggara &&
                                        Auth::user()->penyelenggara->status_verifikasi == 'terverifikasi'
                                    )
                                    <th class="text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendaftaran as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->event->nama_event }}</td>
                                    <td>{{ $item->divisi->nama_divisi }}</td>
                                    <td>{{ $item->volunteer->nama_lengkap }}</td>
                                    <td>
                                        {{ Str::limit($item->motivasi, 50) }}
                                    </td>
                                    <td>
                                        @if ($item->status_pendaftaran == 'menunggu')
                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>
                                        @elseif ($item->status_pendaftaran == 'diterima')
                                            <span class="badge bg-success">
                                                Diterima
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    @if (
                                            Auth::user()->role == 'panitia' &&
                                            Auth::user()->penyelenggara &&
                                            Auth::user()->penyelenggara->status_verifikasi == 'terverifikasi'
                                        )
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-light border-0" data-bs-toggle="dropdown">
                                                    <i class='bx bx-dots-vertical-rounded'></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                                    @if (Auth::user()->role == 'panitia')
                                                        @if ($item->status_pendaftaran == 'menunggu')
                                                            <li>
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#modalVerify{{ $item->id }}">
                                                                    <i class='bx bx-check-circle me-2'></i>
                                                                    Verifikasi
                                                                </button>
                                                            </li>
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
                                    @endif
                                </tr>
                                <div class="modal fade" id="modalVerify{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Verifikasi Pendaftaran Volunteer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i class='bx bx-user-check text-warning' style="font-size:70px;"></i>
                                                <h4 class="mt-3">
                                                    {{ $item->volunteer->nama_lengkap }}
                                                </h4>
                                                <p class="mb-1">
                                                    <strong>Event</strong><br>
                                                    {{ $item->event->nama_event }}
                                                </p>

                                                <p class="mb-3">
                                                    <strong>Divisi</strong><br>
                                                    {{ $item->divisi->nama_divisi }}
                                                </p>

                                                <p class="text-muted">
                                                    Apakah volunteer ini layak diterima sebagai volunteer pada divisi
                                                    tersebut?
                                                </p>

                                            </div>

                                            <div class="modal-footer justify-content-center">

                                                <form action="{{ route('admin.pendaftaran.verifikasi', $item->id) }}"
                                                    method="POST" class="me-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_pendaftaran" value="ditolak">
                                                    <button class="btn btn-danger">
                                                        Tolak
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.pendaftaran.verifikasi', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status_pendaftaran" value="diterima">
                                                    <button class="btn btn-success">
                                                        Terima
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1">

                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Detail Pendaftaran Volunteer
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body d-flex flex-column gap-3">
                                                <div class="area-card gap-3">
                                                    {{-- Data Volunteer --}}
                                                    <div class="card-area-volunteer">
                                                        <h5 class="text-header">
                                                            Data Volunteer
                                                        </h5>
                                                        <div class="area-content-v">
                                                            <div class="area-label-volunteer">
                                                                <label>Nama Lengkap</label>
                                                                <span>{{ $item->volunteer->nama_lengkap }}</span>
                                                            </div>
                                                            <div class="area-label-volunteer">
                                                                <label>Email</label>
                                                                <span>{{ $item->volunteer->user->email }}</span>
                                                            </div>
                                                            <div class="area-label-volunteer">
                                                                <label>No Handphone</label>
                                                                <span>{{ $item->volunteer->no_hp }}</span>
                                                            </div>
                                                            <div class="area-label-volunteer">
                                                                <label>Alamat</label>
                                                                <span>{{ $item->volunteer->alamat }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Data Event --}}
                                                    <div class="card-area-event">
                                                        <h5 class="text-header">
                                                            Data Pendaftaran
                                                        </h5>
                                                        <div class="area-content-e">
                                                            <div class="area-label-event">
                                                                <label>Nama Event</label>
                                                                <span>{{ $item->event->nama_event }}</span>
                                                            </div>
                                                            <div class="area-label-event">
                                                                <label>Divisi</label>
                                                                <span>{{ $item->divisi->nama_divisi }}</span>
                                                            </div>
                                                            <div class="area-label-event">
                                                                <label>Status</label>
                                                                @if ($item->status_pendaftaran == 'diterima')
                                                                    <span class="text-success fw-bold">
                                                                        Diterima
                                                                    </span>
                                                                @elseif ($item->status_pendaftaran == 'ditolak')
                                                                    <span class="text-danger fw-bold">
                                                                        Ditolak
                                                                    </span>
                                                                @else
                                                                    <span class="text-warning fw-bold">
                                                                        Menunggu
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="area-label-event">
                                                                <label>Tanggal Mendaftar</label>
                                                                <span>{{ $item->created_at->format('d M Y H:i') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--
                                                <hr> --}}
                                                <div class="area-motivasi">
                                                    <div class="card-motivasi">
                                                        <label class="label-motivasi">
                                                            Motivasi Volunteer
                                                        </label>
                                                        <div class="content-motivasi">
                                                            <span class="text-motivasi">{{ $item->motivasi }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada data pendaftaran volunteer.
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
        <div id="successToast" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
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
            document.addEventListener("DOMContentLoaded", function () {
                const toastElement = document.getElementById('successToast');
                const toast = new bootstrap.Toast(toastElement, {
                    delay: 3000
                });

                toast.show();
            });
        </script>
    @endif
@endsection