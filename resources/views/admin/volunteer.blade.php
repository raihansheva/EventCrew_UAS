@extends('layouts.mainAdmin')

@section('page-title', 'Volunteer')

@section('content')

    <div class="card">
        <div class="card-body">
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
                        <td>{{ optional($user->volunteer)->nama_lengkap }}</td>
                        <td>{{ optional($user->volunteer)->no_hp }}</td>
                        <td>{{ optional($user->volunteer)->jenis_kelamin }}</td>
                        <td>{{ optional($user->volunteer)->alamat }}</td>
                        <td>{{ optional($user->volunteer)->keahlian }}</td>
                        <td>{{ optional($user->volunteer)->pengalaman }}</td>
                        <td>
                            <form action="{{ route('admin.volunteer.destroy', $user->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data volunteer?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>

                            </form>
                        </td>
                    </tr>

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

@endsection