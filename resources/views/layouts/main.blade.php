<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventCrew</title>
    <link rel="stylesheet" href="{{ asset('style/layout/main.css') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="container">
                <div class="navbar-brand">
                    <h1 class="brand">Event<span class="brand-highlight">Crew</span></h1>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                    <a class="nav-link" href="{{ url('/event') }}">Events</a>
                    <a class="nav-link" href="{{ url('/about') }}">About</a>
                    <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                    <a class="nav-link" href="{{ url('/pendaftaran') }}">Pendaftaran</a>
                    <div class="area-button-login">
                        <div class="button-login" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <p>Login</p>
                        </div>
                    </div>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('login_error'))
                        <div
                            style="background:#fee2e2; color:#dc2626; padding:8px; border-radius:4px; margin-bottom:15px;">
                            {{ session('login_error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div
                            style="background:#dcfce7; color:#16a34a; padding:8px; border-radius:4px; margin-bottom:15px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->has('email'))
                        <div
                            style="background:#fee2e2; color:#dc2626; padding:8px; border-radius:4px; margin-bottom:15px;">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div style="margin-bottom:15px;">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Masukkan email" required
                                style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                        </div>
                        <div style="margin-bottom:15px;">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Masukkan password" required
                                style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                        </div>
                        <button type="submit"
                            style="width:100%; padding:10px; background:#4f46e5; color:#fff; border:none; border-radius:4px; cursor:pointer;">
                            Login
                        </button>
                    </form>

                    <p style="text-align:center; margin-top:15px; font-size:14px;">
                        Belum punya akun?
                        <a href="#"
                            onclick="document.getElementById('modalLogin').style.display='none'; document.getElementById('modalRegister').style.display='block';"
                            style="color:#4f46e5;">Register</a>
                    </p>

                    <button onclick="document.getElementById('modalLogin').style.display='none'"
                        style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:20px; cursor:pointer;">✕</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Register -->
    <div id="modalRegister"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; overflow-y:auto;">
        <div
            style="background:#fff; width:400px; margin:40px auto; border-radius:8px; padding:30px; position:relative;">

            <h5 style="margin-bottom:20px;">Register Volunteer</h5>

            @if (session('register_error'))
                <div style="background:#fee2e2; color:#dc2626; padding:8px; border-radius:4px; margin-bottom:15px;">
                    {{ session('register_error') }}
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="volunteer">

                <div style="margin-bottom:15px;">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan email" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>No HP</label>
                    <input type="text" name="no_hp" placeholder="Masukkan no HP" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div style="margin-bottom:15px;">
                    <label>Alamat</label>
                    <textarea name="alamat" placeholder="Masukkan alamat" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;"></textarea>
                </div>
                <div style="margin-bottom:15px;">
                    <label>Pendidikan <span style="color:#999; font-size:12px;">(opsional)</span></label>
                    <input type="text" name="pendidikan" placeholder="Contoh: SMA, D3, S1"
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Keahlian <span style="color:#999; font-size:12px;">(opsional)</span></label>
                    <input type="text" name="keahlian" placeholder="Contoh: Desain, Fotografi"
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Pengalaman <span style="color:#999; font-size:12px;">(opsional)</span></label>
                    <input type="text" name="pengalaman" placeholder="Contoh: 2 tahun volunteer"
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required
                        style="width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;">
                </div>

                <button type="submit"
                    style="width:100%; padding:10px; background:#4f46e5; color:#fff; border:none; border-radius:4px; cursor:pointer;">
                    Register
                </button>
            </form>

            <p style="text-align:center; margin-top:15px; font-size:14px;">
                Sudah punya akun?
                <a href="#"
                    onclick="document.getElementById('modalRegister').style.display='none'; document.getElementById('modalLogin').style.display='block';"
                    style="color:#4f46e5;">Login</a>
            </p>

            <button onclick="document.getElementById('modalRegister').style.display='none'"
                style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:20px; cursor:pointer;">✕</button>
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
