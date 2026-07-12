@extends('layouts.mainAdmin')

@section('page-title', 'Profile')

<link rel="stylesheet" href="{{ asset('style/admin/adminProfile.css') }}">
@section('content')
    <div class="admin-section">
        <div class="section-body">
            <div class="content-profile">
                <div class="area-kiri-profile">
                    <div class="setting-sidebar">

                        <button class="menu-setting active">
                            <i class='bx bx-user'></i>
                            Profile
                        </button>
                        <button class="menu-setting" data-bs-toggle="modal" data-bs-target="#modalPassword">
                            <i class='bx bx-lock-alt'></i>
                            Password
                        </button>
                    </div>
                </div>
                <div class="area-kanan-profile">
                    <div class="setting-content">
                        <h3>Informasi Profile</h3>
                        <p>
                            Perbarui nama dan email akun panitia.
                        </p>
                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">
                                    Nama Lengkap
                                </label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $admin->penyelenggara->nama_penanggung_jawab }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Email
                                </label>
                                <input type="email" class="form-control" name="email" value="{{ $admin->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Role
                                </label>
                                <input type="text" class="form-control" value="Panitia" readonly>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">
                                    Bergabung Sejak
                                </label>
                                <input type="text" class="form-control"
                                    value="{{ $admin->created_at->translatedFormat('d F Y') }}" readonly>
                            </div>
                            <div class="area-button">
                                <button class="btn btn-dark">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            Ubah Password
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class='bx bx-info-circle me-2 fs-5'></i>
                            Demi keamanan akun, masukkan password lama terlebih dahulu.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Password Lama
                            </label>
                            <input type="password" class="form-control" name="current_password"
                                placeholder="Masukkan password lama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Password Baru
                            </label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password baru"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Konfirmasi Password Baru
                            </label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Ulangi password baru" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-dark">
                            <i class='bx bx-save me-1'></i>
                            Simpan Password
                        </button>
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
