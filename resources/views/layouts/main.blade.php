<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventCrew</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('style/layout/main.css') }}">
</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="navbar-container ">
                <div class="navbar-brand">
                    <h1 class="brand">Event<span class="brand-highlight">Crew</span></h1>
                </div>
                <div class="menu-nav">
                    <div class="menu-nav">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                        <a class="nav-link" href="{{ url('/event') }}">Events</a>
                        <a class="nav-link" href="{{ url('/about') }}">About</a>
                        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                        @guest
                            <div class="area-button-login">
                                <div class="button-login" data-bs-toggle="modal" data-bs-target="#exampleModalLogin">
                                    <p>Login</p>
                                </div>
                            </div>
                        @endguest
                        @auth
                            <a class="nav-link dropdown-toggle text-center" href="#" data-bs-toggle="dropdown">
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <div class="area-menu-drop">
                                    <div class="area-link">
                                        <div class="area-setting">
                                            <a class="dropdown-item" href="/profile">
                                                Akun Saya
                                            </a>
                                            <a class="dropdown-item" href="{{ route('volunteer.pendaftaran') }}">
                                                Pendaftaran Saya
                                            </a>
                                            <a class="dropdown-item" href="{{ route('volunteer.penugasan') }}">
                                                Penugasan Saya
                                            </a>
                                        </div>
                                        <div class="area-logout">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="dropdown-item text-danger" type="submit">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        @endauth
                    </div>
                </div>
        </nav>
        <main>
            @yield('content')
        </main>
        <footer>
            <p>&copy; 2024 EventCrew. All rights reserved.</p>
        </footer>
    </div>

    <div class="modal fade" id="exampleModalLogin" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 modal-content-L">
                <div class="modal-body p-2">
                    <div class="area-modal-login">
                        <div class="area-modal-image">
                            <h2 class="title-login-brand">Hallo!</h2>
                            <p class="desc-login-brand">
                                Bangun pengalaman, perluas relasi, dan ciptakan dampak melalui setiap event yang kamu
                                ikuti.
                            </p>
                            <div class="line-login"></div>
                        </div>
                        <div class="area-login">
                            <h2 class="title-login">Login</h2>
                            @error('login_error')
                                <div class="notifAlert" id="loginAlert">
                                    <p class="textNotif">{{ $message }}</p>
                                </div>
                            @enderror
                            <form class="form-login" action="{{ route('login.post') }}" method="post">
                                @csrf
                                <div class="content-input">
                                    <div class="area-input">
                                        <label for="">Email :</label>
                                        <input class="input-login" type="text" name="email" id=""
                                            placeholder="Masukan email " require />
                                    </div>
                                    <div class="area-input">
                                        <label for="">Password :</label>
                                        <input class="input-login" type="password" name="password" id=""
                                            placeholder="Masukan password" require />
                                    </div>
                                </div>
                                <button class="button-submit-login" type="submit">Login</button>
                                <span class="span-register">Belum punya akun buat daftar event?, <span class="textS"
                                        data-bs-target="#exampleModalPilihan"
                                        data-bs-toggle="modal">Register</span></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalPilihan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow-lg modal-content-L">
                <div class="modal-body p-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-2">Bergabung dengan EventCrew</h2>
                        <p class="text-secondary mb-0">
                            Pilih jenis akun yang ingin Anda daftarkan.
                        </p>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card-pilihan" data-bs-target="#exampleModalRegister" data-bs-toggle="modal">
                                <div class="icon-pilihan">
                                    <i class='bx bx-user'></i>
                                </div>
                                <h4>Volunteer</h4>
                                <p>
                                    Ikuti berbagai event, bangun pengalaman,
                                    perluas relasi, dan tingkatkan kemampuanmu.
                                </p>
                                <span class="btn-pilihan">
                                    Daftar Volunteer →
                                </span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-pilihan" data-bs-target="#exampleModalRegisPanitia"
                                data-bs-toggle="modal">
                                <div class="icon-pilihan">
                                    <i class='bx bx-buildings'></i>
                                </div>
                                <h4>Organizer</h4>
                                <p>
                                    Publikasikan event dan temukan volunteer
                                    terbaik untuk membantu kegiatan Anda.
                                </p>
                                <span class="btn-pilihan">
                                    Daftar Organizer →
                                </span>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <span class="span-register">
                                Sudah punya akun?
                                <span class="textS" role="button" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalLogin">
                                    Login
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalRegister" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 modal-content-L">
                <div class="modal-body p-2">
                    <div class="area-modal-register">
                        <div class="area-modal-image-register">
                            <h2 class="tagline-register">Bergabung Bersama EventCrew</h2>
                            <p class="desc-register">
                                Daftarkan akunmu sekarang dan temukan kesempatan menjadi volunteer
                                di berbagai event yang sesuai dengan minatmu.
                            </p>
                        </div>
                        <div class="area-register">
                            <div class="line"></div>
                            <h2 class="title-register">Register</h2>
                            @error('register_error')
                                <div class="notifAlert" id="regisAlert">
                                    <p class="textNotif">{{ $message }}</p>
                                </div>
                            @enderror
                            <form class="form-register" action="{{ route('register.post') }}" method="post">
                                @csrf
                                <div class="content-regis">
                                    <div class="area-regis-kiri">
                                        <div class="area-input">
                                            <label>Nama Lengkap :</label>
                                            <input class="input-control" type="text" name="nama_lengkap"
                                                placeholder="Masukkan nama lengkap"
                                                value="{{ old('nama_lengkap') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Email :</label>
                                            <input class="input-control" type="email" name="email"
                                                placeholder="Masukkan email" value="{{ old('email') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>No HP :</label>
                                            <input class="input-control" type="text" name="no_hp"
                                                placeholder="Masukkan no HP" value="{{ old('no_hp') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Jenis Kelamin :</label>
                                            <select class="input-control" name="jenis_kelamin">
                                                <option value="">-- Pilih --</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>

                                        <div class="area-input">
                                            <label>Alamat :</label>
                                            <textarea class="text-control" name="alamat" placeholder="Masukkan alamat" rows="5">{{ old('alamat') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="area-regis-kanan">
                                        <div class="area-input">
                                            <label>Tanggal Lahir :</label>
                                            <input class="input-control" type="date" name="tanggal_lahir"
                                                value="{{ old('tanggal_lahir') }}" required>
                                        </div>
                                        <div class="area-input">
                                            <label>Pendidikan : <span
                                                    style="color:#999; font-size:12px;">(opsional)</span></label>
                                            <input class="input-control" type="text" name="pendidikan"
                                                placeholder="Contoh: SMA, D3, S1" value="{{ old('pendidikan') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Keahlian : <span
                                                    style="color:#999; font-size:12px;">(opsional)</span></label>
                                            <input class="input-control" type="text" name="keahlian"
                                                placeholder="Contoh: Desain, Fotografi"
                                                value="{{ old('keahlian') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Pengalaman : <span
                                                    style="color:#999; font-size:12px;">(opsional)</span></label>
                                            <input class="input-control" type="text" name="pengalaman"
                                                placeholder="Contoh: 2 tahun volunteer"
                                                value="{{ old('pengalaman') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Password :</label>
                                            <input class="input-control" type="password" name="password"
                                                placeholder="Masukkan password">
                                        </div>
                                        <div class="area-input">
                                            <label>Konfirmasi Password :</label>
                                            <input class="input-control" type="password" name="password_confirmation"
                                                placeholder="Konfirmasi password">
                                        </div>
                                    </div>
                                </div>
                                <button class="button-submit-register" type="submit">Submit</button>
                                <span class="span-register">Sudah Punya Akun?, <span class="textS"
                                        data-bs-target="#exampleModalLogin" data-bs-toggle="modal">Login</span></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalRegisPanitia" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content rounded-4 modal-content-L">
                <div class="modal-body p-2">
                    <div class="area-modal-register">
                        <div class="area-modal-image-register">
                            <h2 class="tagline-register">Menjadi Penyelenggara Event</h2>
                            <p class="desc-register">
                                Buat akun penyelenggara dan mulai publikasikan event Anda untuk
                                menjangkau volunteer dari berbagai daerah.
                            </p>
                        </div>
                        <div class="area-register">
                            <div class="line"></div>
                            <h2 class="title-register">Register</h2>
                            @error('registerPanitia_error')
                                <div class="notifAlert" id="regisAlert">
                                    <p class="textNotif">{{ $message }}</p>
                                </div>
                            @enderror
                            <form class="form-register" action="{{ route('register.post.panitia') }}"
                                method="post">
                                @csrf
                                <div class="content-regis">
                                    <div class="area-regis-kiri">
                                        <div class="area-input">
                                            <label>Nama Penyelenggara :</label>
                                            <input class="input-control" type="text" name="nama_penyelenggara"
                                                placeholder="Masukkan nama penyelenggara"
                                                value="{{ old('nama_penyelenggara') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Email :</label>
                                            <input class="input-control" type="email" name="email"
                                                placeholder="Masukkan email" value="{{ old('email') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>No HP :</label>
                                            <input class="input-control" type="text" name="no_hp"
                                                placeholder="Masukkan no HP" value="{{ old('no_hp') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Nama Penanggung Jawab ::</label>
                                            <input class="input-control" type="text" name="nama_penanggung_jawab"
                                                placeholder="Masukkan nama penanggung jawab"
                                                value="{{ old('nama_penanggung_jawab') }}">
                                        </div>
                                        <div class="area-input">
                                            <label>Alamat :</label>
                                            <textarea class="text-control" name="alamat" placeholder="Masukkan alamat" rows="5">{{ old('alamat') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="area-regis-kanan">
                                        <div class="area-input">
                                            <label>Deskripsi :</label>
                                            <textarea class="text-control" name="deskripsi" placeholder="Masukkan deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        <div class="area-input">
                                            <label>Password :</label>
                                            <input class="input-control" type="password" name="password"
                                                placeholder="Masukkan password">
                                        </div>
                                        <div class="area-input">
                                            <label>Konfirmasi Password :</label>
                                            <input class="input-control" type="password" name="password_confirmation"
                                                placeholder="Konfirmasi password">
                                        </div>
                                    </div>
                                </div>
                                <button class="button-submit-register" type="submit">Submit</button>
                                <span class="span-register">Sudah Punya Akun?, <span class="textS"
                                        data-bs-target="#exampleModalLogin" data-bs-toggle="modal">Login</span></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('loginAlert');
            const loginModal = document.getElementById('exampleModalLogin');
            const alertRegis = document.getElementById('regisAlert');
            const regisModal = document.getElementById('exampleModalRegister');
            const regisModalP = document.getElementById('exampleModalRegisPanitia');

            if (alert) {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 8000);
            }

            if (alertRegis) {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 8000);
            }

            loginModal.addEventListener('hidden.bs.modal', function() {
                const alert = document.getElementById('loginAlert');

                if (alert) {
                    alert.remove();
                }
            });

            regisModal.addEventListener('hidden.bs.modal', function() {
                const regisAlert = document.getElementById('regisAlert');

                if (regisAlert) {
                    regisAlert.remove();
                }
            });

            regisModalP.addEventListener('hidden.bs.modal', function() {
                const regisAlert = document.getElementById('regisAlert');

                if (regisAlert) {
                    regisAlert.remove();
                }
            });
        });
    </script>
    @error('login_error')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loginModal = new bootstrap.Modal(document.getElementById('exampleModalLogin'));
                loginModal.show();
            });
        </script>
    @enderror
    @error('register_error')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const regisModal = new bootstrap.Modal(document.getElementById('exampleModalRegister'));
                regisModal.show();
            });
        </script>
    @enderror
    @error('registerPanitia_error')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const regisModal = new bootstrap.Modal(document.getElementById('exampleModalRegisPanitia'));
                regisModal.show();
            });
        </script>
    @enderror
</body>

</html>
