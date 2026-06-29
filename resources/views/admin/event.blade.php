@extends('layouts.mainAdmin')

@section('page-title', 'Event')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="admin-section">
    <div class="section-header">
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Data
        </button>
    </div>

    <div class="section-body mt-3">
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
                            <td><span class="badge bg-info">{{ $event->status_event }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $event->status_verifikasi }}</span></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $event->id }}">
                                    Edit
                                </button>
                                |
                                <form action="/data-event/{{ $event->id }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus event ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $event->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="/data-event/{{ $event->id }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Event</label>
                                                <input type="text" name="nama_event" class="form-control" value="{{ $event->nama_event }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <select name="kategori_id" class="form-select" required>
                                                    @foreach($kategoris as $k)
                                                        <option value="{{ $k->id }}" {{ $event->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="3">{{ $event->deskripsi }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi</label>
                                                <input type="text" name="lokasi" class="form-control" value="{{ $event->lokasi }}" required>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label class="form-label">Tanggal Mulai</label>
                                                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $event->tanggal_mulai }}" required>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label">Tanggal Selesai</label>
                                                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ $event->tanggal_selesai }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Poster (kosongkan jika tidak diubah)</label>
                                                <input type="file" name="poster" class="form-control" accept="image/*">
                                                @if($event->poster)
                                                    <img src="{{ asset('storage/'.$event->poster) }}" class="mt-2" width="80">
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status Event</label>
                                                <select name="status_event" class="form-select" required>
                                                    @foreach(['persiapan','open','seleksi','berlangsung','selesai'] as $s)
                                                        <option value="{{ $s }}" {{ $event->status_event == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr><td colspan="9" class="text-center">Belum ada data event.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
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
                    <div class="mb-3">
                        <label class="form-label">Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" required>
                    </div>
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
                            <option value="persiapan">Persiapan</option>
                            <option value="open">Open</option>
                            <option value="seleksi">Seleksi</option>
                            <option value="berlangsung">Berlangsung</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection