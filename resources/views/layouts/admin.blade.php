<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - KWave')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background:#1a1a2e; }
        .sidebar a { color:#eee; display:block; padding:.6rem 1rem; text-decoration:none; }
        .sidebar a:hover, .sidebar a.active { background:#ff2e88; }
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
