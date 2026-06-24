<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventCrew</title>
    <link rel="stylesheet" href="{{ asset('style/layout/main.css') }}">
</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="container">
                <div class="navbar-brand">
                    <h1 class="brand">Event<span class="brand-highlight">Crew</span></h1>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="/">Home</a>
                    <a class="nav-link" href="/event">Events</a>
                    <a class="nav-link" href="/about">About</a>
                    <a class="nav-link" href="/contact">Contact</a>
                    <div class="area-button-login">
                        <div class="button-login">
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
</body>

</html>
