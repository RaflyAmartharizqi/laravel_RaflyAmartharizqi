<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Rumah Sakit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding-top: 60px;
            background-color: #343a40;
            transition: left 0.3s;
            z-index: 1050;
        }
        .sidebar a {
            color: #ddd;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .sidebar .btn-logout {
            width: 90%;
            margin: 10px auto;
            display: block;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }
        .overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }
            .sidebar.show {
                left: 0;
            }
            .content {
                margin-left: 0;
            }
            .navbar-mobile {
                display: flex;
            }
        }
        @media (min-width: 769px) {
            .navbar-mobile {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <h4 class="text-white text-center">Aplikasi RS</h4>
        <a href="{{ route('dashboard') }}">📝 Dashboard</a>
        <a href="{{ route('pasien.index') }}">👤 Pasien</a>
        <a href="{{ route('rumah-sakit.index') }}">🏠 Rumah Sakit</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-warning btn-logout">Logout</button>
        </form>
    </div>

    <div class="overlay" id="overlay"></div>

    <nav class="navbar navbar-light bg-light navbar-mobile d-md-none">
        <div class="container-fluid">
            <button class="btn btn-primary" id="sidebarToggle">☰ Menu</button>
            <span class="navbar-brand mb-0 h1">Aplikasi RS</span>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
</body>
</html>
