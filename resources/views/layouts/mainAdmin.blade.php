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
                            <a href="" class="nav-link active">
                                Dashboard
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-group">
                        <span class="menu-group-title">
                            DATA MASTER
                        </span>
                        <div class="sidebar-menu">
                            <a href="/data-event" class="nav-link">
                                Data Event
                            </a>
                            <a href="/data-kategori" class="nav-link">
                                Data Kategori
                            </a>
                            <a href="/data-volunteer" class="nav-link">
                                Data Volunteer
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-group">
                        <span class="menu-group-title">
                            TRANSAKSI
                        </span>
                        <div class="sidebar-menu">
                            <a href="/data-pendaftaran" class="nav-link">
                                Data Pendaftaran
                            </a>
                            <a href="/event-verifikasi" class="nav-link">
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
                                            admin321@gmail.com
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
                                        <a class="dropdown-item text-danger fw-semibold small" href="#">
                                            Log Out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                </div>
            </aside>
            <main>
                <div class="header-main">
                    <h1 class="brand-main">
                        <span class="brand-main-highlight">Dashboard</span>
                    </h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
</body>

</html>
