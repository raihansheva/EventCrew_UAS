@extends('layouts.mainAdmin')

@section('page-title', 'Kategori Event')

@section('content')
    <div class="admin-section">
        <div class="section-header">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Data
            </button>
        </div>
        <div class="section-body">
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="70">No</th>
                                <th>Nama Kategori</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $i => $k)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td class="text-center">
                                        <div class="dropup">
                                            <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <div class="area-menu-drop">

                                                    <li>
                                                        <button class="dropdown-item drop-edit d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $k->id }}">
                                                            <i class='bx bx-edit-alt me-2'></i>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class="dropdown-item text-danger drop-hapus d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalHapus{{ $k->id }}">
                                                            <i class="bx bx-trash me-2"></i>
                                                            Hapus
                                                        </button>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.kategori.update', $k->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Edit Kategori
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">
                                                        Nama Kategori
                                                    </label>
                                                    <input type="text" name="nama_kategori" class="form-control"
                                                        value="{{ $k->nama_kategori }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button class="btn btn-warning">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalHapus{{ $k->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                                <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
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

                <form action="{{ route('admin.kategori.store') }}" method="POST">

                    @csrf

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Tambah Kategori Event

                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <label class="form-label">

                            Nama Kategori

                        </label>

                        <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan nama kategori"
                            required>

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
