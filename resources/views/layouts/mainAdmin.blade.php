<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventCrew Admin</title>

    <link rel="stylesheet" href="{{ asset('style/layout/mainAdmin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <div class="wrapper">

        <!-- Header -->
        {{-- <header>
            <div class="navbarAdmin">
                <div class="navbar-brand">
                    <h1 class="brand">
                        Event<span class="brand-highlight">Crew Admin</span>
                    </h1>
                </div>

                <div class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger fw-semibold" href="#">Log Out</a></li>
                        </ul>
                    </li>
                </div>

            </div>
        </header> --}}
        <div class="dashboard-layout">
            <aside class="sidebar">
                <div class="area-atas">
                    <div class="header-sidebar">
                        <h1 class="brand">
                            Event<span class="brand-highlight">Crew Admin</span>
                        </h1>
                    </div>
                    <div class="sidebar-group">
                        <span class="menu-group-title">
                            MAIN
                        </span>
                        <div class="sidebar-menu">
                            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-group">
                        <span class="menu-group-title">
                            DATA MASTER
                        </span>
                        <div class="sidebar-menu">
                            <a href="/data-event" class="nav-link {{ request()->is('data-event') ? 'active' : '' }}">
                                Data Event
                            </a>
                            <a href="/data-kategori"
                                class="nav-link {{ request()->is('data-kategori') ? 'active' : '' }}">
                                Data Kategori
                            </a>
                            <a href="/data-volunteer"
                                class="nav-link {{ request()->is('data-volunteer') ? 'active' : '' }}">
                                Data Volunteer
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-group">
                        <span class="menu-group-title">
                            TRANSAKSI
                        </span>
                        <div class="sidebar-menu">
                            <a href="/data-pendaftaran"
                                class="nav-link {{ request()->is('data-pendaftaran') ? 'active' : '' }}">
                                Data Pendaftaran
                            </a>
                            <a href="/event-verifikasi"
                                class="nav-link {{ request()->is('event-verifikasi') ? 'active' : '' }}">
                                Event Verifikasi
                            </a>
                        </div>
                    </div>
                </div>
                <div class="area-bawah">
                    <li class="nav-item dropup-center dropup">
                        <a class="nav-link dropdown-toggle text-center" href="#" data-bs-toggle="dropdown">
                            Admin EventCrew
                        </a>
                        <ul class="dropdown-menu">
                            <div class="area-menu-drop">
                                <div class="area-profile">
                                    <div class="area-foto-profile">
                                        <div class="img"></div>
                                    </div>
                                    <div class="area-account">
                                        <span class="text-username">
                                            Admin EventCrew
                                        </span>

                                        <span class="text-email">
                                            {{ Auth::user()->email }}
                                        </span>
                                    </div>
                                </div>
                                <div class="area-link">
                                    <div class="area-setting">
                                        <a class="dropdown-item" href="#">
                                            Pengaturan
                                        </a>
                                    </div>
                                    <div class="area-logout">
                                        <span class="spanLogout dropdown-item text-danger fw-semibold small"
                                            href="#" data-bs-toggle="modal" data-bs-target="#exampleModalLogout">
                                            Log Out
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                </div>
            </aside>
            <div class="modal fade" id="exampleModalLogout" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">EventCrew</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span>Apakah anda ingin logout?</span>
                        </div>
                        <div class="modal-footer">
                            <form class="form-login" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <main>
                <div class="header-main">
                    <h1 class="brand-main">
                        <span class="brand-main-highlight">
                            @yield('page-title', 'Dashboard')
                        </span>
                    </h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">EventCrew</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Anda berhasil login ke dashboard EventCrew
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
    @if (session('toast_success'))
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
</body>

</html>
