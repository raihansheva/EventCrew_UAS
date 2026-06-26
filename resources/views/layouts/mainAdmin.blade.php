<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventCrew Admin</title>

    <link rel="stylesheet" href="{{ asset('style/layout/mainAdmin.css') }}">
</head>

<body>

    <div class="wrapper">

        <!-- Header -->
        <header>
            <div class="container">

                <div class="navbar-brand">
                    <h1 class="brand">
                        Event<span class="brand-highlight">Crew Admin</span>
                    </h1>
                </div>

                <div class="navbar-nav">
                    <p class="admin-name">Profile</p>

                    <div class="profile">
                        <img src="https://ui-avatars.com/api/?name=Admin" alt="">
                    </div>
                </div>

            </div>
        </header>
        <div class="dashboard-layout">
            <aside class="sidebar">
                <div class="sidebar-menu">
                    <a href="" class="nav-link active">Dashboard</a>
                    <a href="" class="nav-link">Event</a>
                    <a href="" class="nav-link">Registration</a>
                    <a href="" class="nav-link">Category</a>
                </div>

            </aside>
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>