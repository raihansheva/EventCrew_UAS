<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventCrew</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="{{ asset('style/layout/main.css') }}">
</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="navbar-container">
                <div class="navbar-brand">
                    <h1 class="brand">Event<span class="brand-highlight">Crew</span></h1>
                </div>
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
                                        <a class="dropdown-item" href="#">
                                            Akun Saya
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
</body>

</html>
