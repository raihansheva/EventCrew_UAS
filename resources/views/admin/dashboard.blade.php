@extends('layouts.mainAdmin')

@section('page-title', 'Dashboard')

<link rel="stylesheet" href="{{ asset('style/admin/dashboard.css') }}">

@section('content')
    @if (Auth::user()->role == 'admin')
        <div class="admin-section">
            <div class="section-body">
                <div class="row g-4 mb-4">
                    <div class="col-lg-3">
                        <div class="dashboard-stat pink">
                            <h2>{{ $totalVolunteer }}</h2>
                            <span>Total Volunteer</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="dashboard-stat yellow">
                            <h2>{{ $totalEvent }}</h2>
                            <span>Total Event</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="dashboard-stat green">
                            <h2>{{ $totalPendaftaran }}</h2>
                            <span>Total Pendaftaran</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="dashboard-stat blue">
                            <h2>{{ $totalPenugasan }}</h2>
                            <span>Total Penugasan</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Event Terbaru
                            </div>
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Penyelenggara</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($eventTerbaru as $item)
                                        <tr>
                                            <td>{{ $item->nama_event }}</td>
                                            <td>
                                                {{ $item->panitia->penyelenggara->nama_penyelenggara }}
                                            </td>
                                            <td>
                                                @if ($item->status_verifikasi == 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($item->status_verifikasi == 'menunggu')
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->tanggal_mulai }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                Belum ada data.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Menunggu Verifikasi
                            </div>
                            <table class="table">
                                <tbody>
                                    @forelse($eventMenunggu as $item)
                                        <tr>
                                            <td>
                                                <strong>{{ $item->nama_event }}</strong>
                                                <br>
                                                <small>
                                                    {{ $item->panitia->nama_penyelenggara }}
                                                </small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Tidak ada event.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Pendaftaran Terbaru
                            </div>
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Volunteer</th>
                                        <th>Event</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendaftaranTerbaru as $item)
                                        <tr>
                                            <td>{{ $item->volunteer->nama_lengkap }}</td>
                                            <td>{{ $item->event->nama_event }}</td>
                                            <td>{{ ucfirst($item->status_pendaftaran) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Penugasan Aktif
                            </div>
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Volunteer</th>
                                        <th>Event</th>
                                        <th>Divisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penugasanAktif as $item)
                                        <tr>
                                            <td>{{ $item->pendaftaran->volunteer->nama_lengkap }}</td>
                                            <td>{{ $item->pendaftaran->event->nama_event }}</td>
                                            <td>{{ $item->pendaftaran->divisi->nama_divisi }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Belum ada penugasan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'panitia')
        <div class="admin-section">
           
            <div class="section-body">

                {{-- Statistik --}}
                <div class="row g-4 mb-4">

                    <div class="col-lg-4">
                        <div class="dashboard-stat pink">
                            <h2>{{ $totalEvent }}</h2>
                            <span>Event Saya</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="dashboard-stat yellow">
                            <h2>{{ $totalPendaftaran }}</h2>
                            <span>Total Pendaftaran</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="dashboard-stat blue">
                            <h2>{{ $totalPenugasan }}</h2>
                            <span>Total Penugasan</span>
                        </div>
                    </div>

                </div>

                <div class="row">

                    {{-- Event Saya --}}
                    <div class="col-lg-12 mb-4">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Event Saya
                            </div>

                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Nama Event</th>
                                        <th>Status</th>
                                        <th>Tanggal Mulai</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($eventTerbaru as $item)
                                        <tr>
                                            <td>{{ $item->nama_event }}</td>

                                            <td>
                                                @if ($item->status_verifikasi == 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($item->status_verifikasi == 'menunggu')
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>

                                            <td>{{ $item->tanggal_mulai }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                Belum ada event.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="row">

                    {{-- Pendaftaran --}}
                    <div class="col-lg-6">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Pendaftaran Terbaru
                            </div>

                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Volunteer</th>
                                        <th>Event</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($pendaftaranTerbaru as $item)
                                        <tr>
                                            <td>{{ $item->volunteer->nama_lengkap }}</td>
                                            <td>{{ $item->event->nama_event }}</td>
                                            <td>{{ ucfirst($item->status_pendaftaran) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                Belum ada data.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>
                    </div>

                    {{-- Penugasan --}}
                    <div class="col-lg-6">
                        <div class="dashboard-table">
                            <div class="table-title">
                                Penugasan Aktif
                            </div>

                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Volunteer</th>
                                        <th>Event</th>
                                        <th>Divisi</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($penugasanAktif as $item)
                                        <tr>
                                            <td>
                                                {{ $item->pendaftaran->volunteer->nama_lengkap }}
                                            </td>

                                            <td>
                                                {{ $item->pendaftaran->event->nama_event }}
                                            </td>

                                            <td>
                                                {{ $item->pendaftaran->divisi->nama_divisi }}
                                            </td>

                                            <td>
                                                {{ $item->tanggal_tugas }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                Belum ada penugasan.
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
    @endif
@endsection
