<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Jaya Berkah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #e8f5e9; /* Hijau muda */
        }
        .sidebar {
            background-color: #2e7d32; /* Hijau tua */
            min-width: 200px;
            height: 100vh;
        }
        .sidebar .logo {
            text-align: center;
            padding: 20px 0;
        }
        .sidebar .logo img {
            width: 60px;
            border-radius: 50%;
        }
        .sidebar .nav-link.active {
            background-color: #1b5e20;
            color: #fff !important;
        }
        .sidebar .nav-link {
            color: white;
            margin: 5px 0;
        }
        .sidebar .nav-link:hover {
            background-color: #1b5e20;
            color: #fff !important;
        }
        .header {
            background-color: #2e7d32; /* Hijau tua */
            color: white;
            padding: 15px 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-3">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
            </div>
            <ul class="nav flex-column text-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pelanggan*') ? 'active' : '' }}" href="{{ url('/pelanggan') }}">Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}" href="{{ url('/user') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}" href="{{ url('/penjualan') }}">Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('detail-penjualan*') ? 'active' : '' }}" href="{{ url('/detail-penjualan') }}">Detail Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan</a>
                </li>
                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger w-100" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <div class="flex-grow-1">
            <header class="header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">UMKM Jaya Berkah</h4>
                @auth
                    <span>👤 {{ Auth::user()->nama_lengkap ?? Auth::user()->username }}</span>
                @endauth
            </header>

            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
