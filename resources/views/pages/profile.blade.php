@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/profile.css') }}">

@section('content')
    <section class="section-1">
        <div class="area-profile">
            <div class="area-kiri-profile">
                <div class="card-profile">
                    <div class="foto-profile">
                        {{-- <img src="{{ asset('storage/' . ($profile->volunteer->foto ?? 'images/default-user.png')) }}"> --}}
                        <div class="foto"></div>
                    </div>
                    <div class="area-name">
                        <h3 class="name">{{ $profile->volunteer->nama_lengkap }}</h3>
                        <span class="badge-role">
                            Volunteer
                        </span>
                    </div>
                    <div class="info-singkat">
                        <span class="area-IS">
                            <i class='bx bx-envelope mail'></i>
                            {{ $profile->email }}
                        </span>
                        <span class="area-IS">
                            <i class='bx bx-phone phone'></i>
                            {{ $profile->volunteer->no_hp }}
                        </span>
                    </div>
                    <div class="btn-edit" data-bs-toggle="modal" data-bs-target="#modalPassword">
                        <i class='bx bx-lock-alt me-2'></i>
                        <span>Ubah Password</span>
                    </div>
                </div>
            </div>
            <div class="area-kanan-profile">
                <div class="card-statistik">
                    <div class="item-statistik">
                        <div class="area-icon-statistik total">
                            <i class='bx bx-file' style="color: #4f46e5;"></i>
                        </div>
                        <div class="content-statistik">
                            <h3>{{ $totalPendaftaran }}</h3>
                            <span>Total Daftar</span>
                        </div>
                    </div>
                    <div class="item-statistik">
                        <div class="area-icon-statistik diterima">
                            <i class='bx bx-check-circle' style="color: #16a34a;"></i>
                        </div>
                        <div class="content-statistik">
                            <h3>{{ $totalDiterima }}</h3>
                            <span>Diterima</span>
                        </div>
                    </div>
                    <div class="item-statistik">
                        <div class="area-icon-statistik menunggu">
                            <i class='bx bx-time-five' style="color: #f59e0b;"></i>
                        </div>
                        <div class="content-statistik">
                            <h3>{{ $totalMenunggu }}</h3>
                            <span>Menunggu</span>
                        </div>
                    </div>
                    <div class="item-statistik">
                        <div class="area-icon-statistik ditolak">
                            <i class='bx bx-x-circle' style="color: #dc2626;"></i>
                        </div>
                        <div class="content-statistik">
                            <h3>{{ $totalDitolak }}</h3>
                            <span>Ditolak</span>
                        </div>
                    </div>
                </div>
                <div class="card-informasi">
                    <div class="header-card">
                        <div class="area-title-header">
                            <h3>Informasi Pribadi</h3>
                            <span class="badge bg-success">
                                <i class='bx bx-badge-check'></i>
                                Akun Terverifikasi
                            </span>
                        </div>
                        <div class="btn-edit-2" data-bs-toggle="modal" data-bs-target="#modalEditProfile">
                            <i class='bx bx-edit-alt'></i>
                            {{-- <span>Edit Profil</span> --}}
                        </div>
                    </div>
                    <div class="content-informasi">
                        <div class="item-info">
                            <label>Nama Lengkap</label>
                            <span>{{ $profile->volunteer->nama_lengkap }}</span>
                        </div>

                        <div class="item-info">
                            <label>Email</label>
                            <span>{{ $profile->email }}</span>
                        </div>

                        <div class="item-info">
                            <label>Nomor Handphone</label>
                            <span>{{ $profile->volunteer->no_hp }}</span>
                        </div>

                        <div class="item-info">
                            <label>Jenis Kelamin</label>
                            <span>{{ $profile->volunteer->jenis_kelamin }}</span>
                        </div>

                        <div class="item-info">
                            <label>Tanggal Lahir</label>
                            <span>
                                {{ \Carbon\Carbon::parse($profile->volunteer->tanggal_lahir)->translatedFormat('d F Y') }}
                            </span>
                        </div>

                        <div class="item-info">
                            <label>Pendidikan</label>
                            <span>{{ $profile->volunteer->pendidikan }}</span>
                        </div>

                        <div class="item-info item-full">
                            <label>Alamat</label>
                            <span>{{ $profile->volunteer->alamat }}</span>
                        </div>

                        <div class="item-info item-full">
                            <label>Keahlian</label>
                            <span>{{ $profile->volunteer->keahlian ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-area-evaluasi">
                    <div class="card-header-AE">
                        <h3>
                            <i class='bx bx-medal'></i>
                            Evaluasi Saya
                        </h3>
                    </div>
                    <div class="card-body-AE">
                        @forelse ($evaluasi as $item)
                            <div class="card-evaluasi">
                                <div class="evaluasi-header">
                                    <div>
                                        <h5>
                                            {{ $item->penugasan->pendaftaran->event->nama_event }}
                                        </h5>
                                        <small>
                                            {{ $item->penugasan->pendaftaran->divisi->nama_divisi }}
                                        </small>
                                    </div>
                                    <span
                                        class="badge
                                         @if ($item->nilai == 5) bg-success
                                         @elseif($item->nilai == 4)
                                             bg-primary
                                         @elseif($item->nilai == 3)
                                             bg-info text-dark
                                         @elseif($item->nilai == 2)
                                             bg-warning text-dark
                                         @else
                                             bg-danger @endif">
                                        @if ($item->nilai == 5)
                                            Sangat Baik
                                        @elseif($item->nilai == 4)
                                            Baik
                                        @elseif($item->nilai == 3)
                                            Cukup
                                        @elseif($item->nilai == 2)
                                            Kurang
                                        @else
                                            Sangat Kurang
                                        @endif
                                    </span>
                                </div>
                                <div class="area-content-text">
                                    <div class="evaluasi-score">
                                        <span class="text-nilai">Nilai</span>
                                        <span class="nilai">{{ $item->nilai }}/5</span>
                                    </div>
                                    <div class="evaluasi-komentar">
                                        <label class="text-komen">Komentar</label>
                                        <p class="desk-komen">
                                            {{ $item->komentar }}
                                        </p>
                                    </div>
                                    <small class="text-muted">
                                        Dievaluasi
                                        {{ $item->created_at->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <div class="empty-evaluasi">
                                <i class='bx bx-message-square-x'></i>
                                <h5>
                                    Belum Ada Evaluasi
                                </h5>
                                <p>
                                    Evaluasi akan muncul setelah panitia
                                    memberikan penilaian terhadap tugas Anda.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalEditProfile" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Profil
                    </h4>
                    <button class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="{{ route('profile.volunteer.update', $profile->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap"
                                        value="{{ old('nama_lengkap', $profile->volunteer->nama_lengkap) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $profile->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. Handphone</label>
                                    <input type="text" class="form-control" name="no_hp"
                                        value="{{ old('no_hp', $profile->volunteer->no_hp) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="Laki-laki"
                                            {{ $profile->volunteer->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ $profile->volunteer->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" rows="3" name="alamat">{{ old('alamat', $profile->volunteer->alamat) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $profile->volunteer->tanggal_lahir) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Pendidikan
                                        <small class="text-muted">(Opsional)</small>
                                    </label>
                                    <input type="text" class="form-control" name="pendidikan"
                                        value="{{ old('pendidikan', $profile->volunteer->pendidikan) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Keahlian
                                        <small class="text-muted">(Opsional)</small>
                                    </label>
                                    <input type="text" class="form-control" name="keahlian"
                                        value="{{ old('keahlian', $profile->volunteer->keahlian) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Pengalaman
                                        <small class="text-muted">(Opsional)</small>
                                    </label>
                                    <input type="text" class="form-control" name="pengalaman"
                                        value="{{ old('pengalaman', $profile->volunteer->pengalaman) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
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
    <div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 ">
                <form action="{{ route('volunteer.password.update') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title fw-bold">
                            <i class='bx bx-lock-alt me-2'></i>
                            Ubah Password
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted mb-4">
                            Demi keamanan akun, masukkan password lama terlebih dahulu kemudian buat password baru.
                        </p>
                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" class="form-control" name="current_password"
                                placeholder="Masukkan password lama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Masukkan password baru" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Konfirmasi password baru" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class='bx bx-check me-1'></i>
                            Simpan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successToast" class="toast align-items-center border-0 text-bg-success" role="alert"
                aria-live="assertive" aria-atomic="true">

                <div class="d-flex">
                    <div class="toast-body">
                        <i class='bx bx-check-circle me-2'></i>
                        {{ session('success') }}
                    </div>

                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
                    </button>
                </div>

            </div>
        </div>
    @endif
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toastEl = document.getElementById('successToast');

                if (toastEl) {
                    const toast = new bootstrap.Toast(toastEl, {
                        delay: 3500
                    });

                    toast.show();
                }
            });
        </script>
    @endif
@endsection
