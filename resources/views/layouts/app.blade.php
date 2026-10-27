<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KWave - Portal Berita K-Pop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --pink: #ff3f9f;
            --purple: #8b5cf6;
            --dark: #17121f;
            --text: #25202b;
            --muted: #77717d;
            --light: #faf9fc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--light);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }


        .kwave-navbar {
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid #eee8f2;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background 0.3s ease, box-shadow 0.3s ease,
                        backdrop-filter 0.3s ease;
        }

        .kwave-navbar.scrolled {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 5px 24px rgba(40, 20, 50, 0.08);
            border-bottom-color: rgba(255, 63, 159, 0.12);
        }

        .kwave-logo {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -1px;
            text-decoration: none;
            color: var(--dark);
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .kwave-logo span {
            background: linear-gradient(120deg, #ff3f9f, #b46bff, #ff3f9f);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: kwave-gradient 4s linear infinite;
        }

        .kwave-logo .kwave-star {
            display: inline-block;
            margin-left: 2px;
            font-size: 15px;
            color: #ff3f9f;
            -webkit-text-fill-color: #ff3f9f;
            animation: kwave-twinkle 1.8s ease-in-out infinite;
        }

        .kwave-logo:hover {
            transform: translateY(-2px);
            filter: drop-shadow(0 3px 8px #ff3f9f40);
        }

        @keyframes kwave-gradient {
            to {
                background-position: 200% center;
            }
        }

        @keyframes kwave-twinkle {
            0%, 100% {
                opacity: 0.55;
                transform: scale(0.85) rotate(-10deg);
            }
            50% {
                opacity: 1;
                transform: scale(1.15) rotate(10deg);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .kwave-logo,
            .kwave-logo span,
            .kwave-logo .kwave-star {
                animation: none;
                transition: none;
            }
        }

        .nav-link {
            color: #4b4552 !important;
            font-weight: 600;
            margin: 0 4px;
        }

        .nav-link:hover {
            color: var(--pink) !important;
        }

        .search-box {
            border: 1px solid #e5dfea;
            border-radius: 50px;
            padding: 8px 15px;
            background: #faf9fc;
        }

        .search-box:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(255, 63, 159, 0.1);
        }

        .btn-search {
            background: var(--dark);
            color: white;
            border-radius: 50px;
            padding: 8px 18px;
            border: none;
        }

        .btn-search:hover {
            background: var(--pink);
            color: white;
        }

        .btn-login {
            border: 1px solid #ddd5e3;
            border-radius: 50px;
            padding: 7px 16px;
            color: var(--dark);
            text-decoration: none;
            font-weight: 600;
        }

        .btn-login:hover {
            background: var(--dark);
            color: white;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
            padding: 0;
            border: 2px solid #f3d9e8;
            border-radius: 50%;
            overflow: hidden;
            background: #fce7f3;
            color: #ff3f9f;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar:hover {
            border-color: #ff3f9f;
            box-shadow: 0 0 0 3px rgba(255, 63, 159, 0.12);
        }

        .profile-avatar:focus-visible {
            outline: 2px solid #ff3f9f;
            outline-offset: 3px;
        }

        main {
            min-height: 75vh;
        }

        .category-menu {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 5px;
        }

        .category-menu::-webkit-scrollbar {
            display: none;
        }

        .category-btn {
            white-space: nowrap;
            border: 1px solid #e5dfea;
            background: white;
            color: #514957;
            border-radius: 50px;
            padding: 8px 18px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .category-btn:hover,
        .category-btn.active {
            background: var(--pink);
            border-color: var(--pink);
            color: white;
        }

        .news-card {
            background: white;
            border: 1px solid #eee8f2;
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            transition: 0.2s ease;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(30, 20, 40, 0.08);
        }

        .news-card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .news-card-body {
            padding: 18px;
        }

        .news-category {
            display: inline-block;
            color: var(--pink);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .news-title {
            color: var(--text);
            font-size: 18px;
            font-weight: 700;
            line-height: 1.35;
            text-decoration: none;
        }

        .news-title:hover {
            color: var(--pink);
        }

        .news-meta {
            color: var(--muted);
            font-size: 13px;
            margin-top: 12px;
        }


        .section-title {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .section-title::after {
            content: "";
            display: block;
            width: 45px;
            height: 4px;
            background: linear-gradient(90deg, var(--pink), var(--purple));
            border-radius: 10px;
            margin-top: 7px;
        }

        .kwave-footer {
            background: var(--dark);
            color: #bdb5c5;
            margin-top: 60px;
            padding: 40px 0 20px;
        }

        .footer-logo {
            color: white;
            font-size: 24px;
            font-weight: 800;
        }

        .footer-logo span {
            color: var(--pink);
        }

        .footer-text {
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-bottom {
            border-top: 1px solid #30283a;
            margin-top: 25px;
            padding-top: 18px;
            font-size: 13px;
        }

        @media (max-width: 768px) {

            .kwave-logo {
                font-size: 24px;
            }
            .search-box-wrapper {
                margin-top: 12px;
                margin-bottom: 10px;
            }
            .news-card img {
                height: 190px;
            }
            .section-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg kwave-navbar">
        <div class="container py-2">

            <a class="kwave-logo" href="{{ route('home') }}">
                K<span>Wave</span><span class="kwave-star" aria-hidden="true">✦</span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#kwaveNav"
                aria-controls="kwaveNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="kwaveNav">
                <ul class="navbar-nav ms-lg-4 me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    @if(isset($kategoris))
                        @foreach($kategoris->take(5) as $kat)
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('home', ['kategori' => $kat->id_kategori]) }}">
                                    {{ $kat->nama_kategori }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <form
                    class="d-flex search-box-wrapper me-lg-3"
                    method="GET"
                    action="{{ route('home') }}">

                    <input
                        class="form-control search-box"
                        type="search"
                        name="q"
                        placeholder="Cari berita..."
                        value="{{ request('q') }}">

                    <button class="btn btn-search ms-2" type="submit">
                        Cari
                    </button>
                </form>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ url('/admin') }}" class="btn-login me-2">
                        Admin
                    </a>
                @elseif(auth()->user()->role === 'author')
                    <a href="{{ url('/author') }}" class="btn-login me-2">
                        Dashboard Author
                    </a>
                @else
                    <div class="dropdown me-2">
                        <button
                            class="profile-avatar"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Buka menu profil">

                            @if(auth()->user()->foto_profil)
                                <img
                                    src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                                    alt="Foto profil">
                            @else
                                <span>
                                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                                </span>
                            @endif
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2">
                            <li class="px-3 py-2">
                                <strong>{{ auth()->user()->nama }}</strong>
                                <div class="small text-muted">
                                    {{ auth()->user()->email }}
                                </div>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a class="dropdown-item rounded-3"
                                href="{{ route('profile.edit') }}">
                                    Edit Profil
                                </a>
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item rounded-3 text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-login">
                    Login Sekarang
                </a>
            @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="kwave-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <div class="footer-logo">
                        K<span>Wave</span>
                    </div>

                    <p class="footer-text mt-2">
                        Portal berita K-Pop yang menghadirkan
                        berbagai informasi terbaru seputar idol,
                        musik, comeback, MV, dan K-Culture.
                    </p>
                </div>

                <div class="col-md-6 text-md-end">
                    <p class="footer-text mb-1">
                        Follow the latest K-Pop updates.
                    </p>
                    <p class="footer-text">
                        K-News · Music · Comeback · K-Culture
                    </p>
                </div>
            </div>

            <div class="footer-bottom text-center">
                &copy; {{ date('Y') }} KWave — Portal Berita K-Pop
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const kwaveNavbar = document.querySelector('.kwave-navbar');

        function updateKwaveNavbar() {
            if (!kwaveNavbar) return;

            kwaveNavbar.classList.toggle('scrolled', window.scrollY > 20);
        }

        window.addEventListener('scroll', updateKwaveNavbar, { passive: true });
        updateKwaveNavbar();
    </script>

</body>
</html>