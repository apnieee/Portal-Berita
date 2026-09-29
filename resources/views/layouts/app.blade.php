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
            background: #ffffff;
            border-bottom: 1px solid #eee8f2;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .kwave-logo {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -1px;
            text-decoration: none;
            color: var(--dark);
        }

        .kwave-logo span {
            color: var(--pink);
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
                K<span>Wave</span>
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
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="btn-login me-2">
                            Admin
                        </a>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="d-inline">
                        @csrf

                        <button
                            type="submit"
                            class="btn-login bg-transparent">
                            Logout
                        </button>
                    </form>

                @else
                    <a
                        href="{{ route('login') }}"
                        class="btn-login">
                        Login
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

</body>
</html>