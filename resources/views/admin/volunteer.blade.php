@extends('layouts.mainAdmin')

@section('page-title', 'Volunteer')

<link rel="stylesheet" href="{{ asset('style/admin/adminVolunteer.css') }}">
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
                                <th>Nama Lengkap</th>
                                <th>No HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Keahlian</th>
                                <th>Pengalaman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($volunteers as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->volunteer->nama_lengkap }}</td>
                                    <td>{{ $user->volunteer->no_hp }}</td>
                                    <td>{{ $user->volunteer->jenis_kelamin }}</td>
                                    <td>{{ $user->volunteer->alamat }}</td>
                                    <td>{{ $user->volunteer->keahlian }}</td>
                                    <td>{{ $user->volunteer->pengalaman }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light border-0" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                                <div class="area-menu-drop">

                                                    {{-- <li>
                                                <button class="dropdown-item drop-edit d-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}">
                                                    <i class='bx bx-edit-alt me-2'></i>
                                                    Edit
                                                </button>
                                            </li> --}}
                                                    <li>
                                                        <button class="dropdown-item drop-detail d-flex align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDetail{{ $user->id }}">
                                                            <i class='bx bx-show me-2'></i>
                                                            Detail
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
                                                <h5 class="modal-title">Hapus Volunteer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-input text-center">
                                                    <label for="">Apakah Anda yakin ingin menghapus volunteer
                                                        ini?</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.volunteer.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalDetail{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Volunteer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="area-content-detail">
                                                    <div class="content-kiri">
                                                        <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-envelope'></i> Email</label>
                                                                <span class="value-event">{{ $user->email }}</span>
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
                                                                <span
                                                                    class="value-event">{{ $user->role }}</span>
                                                            </div>
                                                    </div>
                                                    <div class="content-kanan">
                                                        <div class="area-kiri-detail">
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-user'></i> Nama
                                                                    Volunteer</label>
                                                                <span class="value-event">{{ $user->volunteer->nama_lengkap }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-phone'></i> Nomer Handphone</label>
                                                                <span class="value-event">{{ $user->volunteer->no_hp }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-male-female'></i>
                                                                    Jenis Kelamin</label>
                                                                <span
                                                                    class="value-event">{{ $user->volunteer->jenis_kelamin }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-map text-danger'></i>
                                                                    Alamat</label>
                                                                <span
                                                                    class="value-event">{{ $user->volunteer->alamat }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="area-kanan-detail">
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-brain'></i>
                                                                    Keahlian</label>
                                                                <span
                                                                    class="value-event">{{ $user->volunteer->keahlian ?? '-' }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-briefcase-alt-2'></i> Pengalaman</label>
                                                                <span
                                                                    class="value-event">{{ $user->volunteer->pengalaman ?? '-' }}</span>
                                                            </div>
                                                            <div class="area-label">
                                                                <label class="label-event" for=""><i
                                                                        class='bx bx-book-open'></i> Pendidikan</label>
                                                                <span
                                                                    class="value-event">{{ $user->volunteer->pendidikan ?? '-' }}</span>
                                                            </div>
                                                            {{-- <div class="area-label">
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
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
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
@endsection
