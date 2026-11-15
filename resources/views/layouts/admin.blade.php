<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - KWave')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --pink: #ff3f9f;
            --purple: #8b5cf6;
            --dark: #17121f;
            --surface: #ffffff;
            --text: #25202b;
            --muted: #77717d;
            --border: #eee8f2;
        }

        body {
            background: #faf9fc;
            color: var(--text);
        }

        .sidebar {
            min-height: 100vh;
            background: var(--dark);
        }

        .sidebar h5 {
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .sidebar a {
            color: #eee;
            display: block;
            padding: .6rem 1rem;
            text-decoration: none;
            transition: background .2s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: var(--pink);
            color: white;
        }

        main {
            min-width: 0;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar p-0">
            <h5 class="text-white p-3">KWave Admin</h5>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.kategori.index') }}">Kategori</a>
            <a href="{{ route('admin.berita.index') }}">Berita</a>
            <a href="{{ route('admin.banner.index') }}">Banner</a>
            <a href="{{ route('admin.laporan.index') }}">Laporan</a>
            <a href="{{ route('home') }}">Lihat Website</a>
            <form method="POST" action="{{ route('logout') }}" class="px-3 mt-3">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100">Logout</button>
            </form>
        </nav>
        <main class="col-md-10 p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
