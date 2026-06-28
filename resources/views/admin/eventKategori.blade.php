@extends('layouts.mainAdmin')

@section('page-title', 'Kategori Event')

@section('content')

@if(session('success'))
    <div id="alert-success" class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">

    <div class="card-body">

        <div class="mb-3">

            <button class="btn btn-warning fw-bold"
                data-bs-toggle="modal"
                data-bs-target="#addModal">

                <i class="fa-solid fa-plus"></i>
                Tambah Data

            </button>

        </div>

        <div class="table-responsive">

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

                        <td class="text-center">{{ $i+1 }}</td>

                        <td>{{ $k->nama_kategori }}</td>

                        <td class="text-center">

                            <button
                                class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $k->id }}">

                                Edit

                            </button>

                            <form
                                action="{{ route('admin.kategori.destroy',$k->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    <!-- Modal Edit -->

                    <div class="modal fade"
                        id="editModal{{ $k->id }}"
                        tabindex="-1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <form
                                    action="{{ route('admin.kategori.update',$k->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            Edit Kategori

                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <label class="form-label">

                                            Nama Kategori

                                        </label>

                                        <input
                                            type="text"
                                            name="nama_kategori"
                                            class="form-control"
                                            value="{{ $k->nama_kategori }}"
                                            required>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">

                                            Batal

                                        </button>

                                        <button
                                            class="btn btn-warning">

                                            Update

                                        </button>

                                    </div>

                                </form>

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

<!-- Modal Tambah -->

<div class="modal fade" id="addModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="{{ route('admin.kategori.store') }}"
                method="POST">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah Kategori Event

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <label class="form-label">

                        Nama Kategori

                    </label>

                    <input
                        type="text"
                        name="nama_kategori"
                        class="form-control"
                        placeholder="Masukkan nama kategori"
                        required>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        class="btn btn-warning">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen alert berdasarkan ID
        const alertElement = document.getElementById('alert-success');
        
        if (alertElement) {
            // Tunggu 3 detik (3000ms), lalu jalankan efek menghilang
            setTimeout(function() {
                // Beri efek transisi smooth fade-out
                alertElement.style.transition = "opacity 0.5s ease";
                alertElement.style.opacity = "0";
                
                // Hapus total elemen dari halaman setelah efek fade-out selesai (500ms)
                setTimeout(function() {
                    alertElement.remove();
                }, 500); 
            }, 3000); 
        }
    });
</script>