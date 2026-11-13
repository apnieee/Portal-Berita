
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KWave - Portal Berita K-Pop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            position: relative;
            width: 48px;
            height: 40px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .kwave-logo img {
            position: absolute;
            width: 100px;
            height: 100px;
            max-width: none;
            object-fit: contain;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .kwave-logo:hover {
            transform: translateY(-2px);
            filter: drop-shadow(0 3px 8px #b46bff40);
        }

        @media (max-width: 768px) {
            .kwave-logo img {
                height: 90px;
                width: 90px;
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

        .news-card.reveal-on-scroll {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.6s ease, transform 0.6s ease,
                        box-shadow 0.2s ease;
        }

        .news-card.reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .news-card.reveal-on-scroll.is-visible:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(30, 20, 40, 0.08);
        }

        @media (prefers-reduced-motion: reduce) {
            .news-card.reveal-on-scroll,
            .news-card.reveal-on-scroll.is-visible {
                opacity: 1;
                transform: none;
                transition: none;
            }
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
            padding: 5px 12px;
            background: #fce7f3;
            color: #e92e8b;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
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

        #bannerCarousel {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        #bannerCarousel.banner-visible {
            opacity: 1;
            transform: translateY(0);
        }

        #bannerCarousel .carousel-caption .badge,
        #bannerCarousel .carousel-caption h2,
        #bannerCarousel .carousel-caption a {
            animation: bannerTextIn 0.7s ease both;
        }

        #bannerCarousel .carousel-caption h2 {
            animation-delay: 0.15s;
        }

        #bannerCarousel .carousel-caption a {
            animation-delay: 0.3s;
        }

        @keyframes bannerFadeIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bannerTextIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            #bannerCarousel,
            #bannerCarousel .carousel-caption .badge,
            #bannerCarousel .carousel-caption h2,
            #bannerCarousel .carousel-caption a {
                animation: none;
            }
        }

        .theme-toggle {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd5e3;
            border-radius: 50%;
            background: transparent;
            color: var(--dark);
            cursor: pointer;
            font-size: 17px;
            transition: 0.2s ease;
            flex-shrink: 0;
        }

        .theme-toggle:hover {
            background: #fce7f3;
            color: var(--pink);
        }

        .author-card {
            height: 100%;
            min-height: 215px;
            padding: 25px 18px;
            border: 1px solid #eee8f2;
            border-radius: 18px;
            background: white;
            text-align: center;
            transition: 0.25s ease;
        }

        .author-card:hover {
            transform: translateY(-5px);
            border-color: #ff3f9f;
            box-shadow: 0 10px 25px rgba(30, 20, 40, 0.08);
        }

        .author-avatar {
            width: 82px;
            height: 82px;
            margin: 0 auto 16px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ff3f9f;
            color: white;
            font-size: 30px;
            font-weight: 700;
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-name {
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text);
        }

        .author-label {
            display: inline-block;
            font-size: 12px;
            color: var(--pink);
            font-weight: 600;
        }

        .author-empty {
            padding: 30px;
            border-radius: 16px;
            background: white;
            text-align: center;
            color: var(--muted);
        }

        .dark-mode .author-card,
        .dark-mode .author-empty {
            background: #25212c;
            border-color: #403847;
            color: #eeeaf2;
        }

        .dark-mode .author-name {
            color: #eeeaf2;
        }

        body.dark-mode {
            --light: #17151c;
            --text: #eeeaf2;
            --muted: #aaa2b2;
            background: var(--light);
            color: var(--text);
        }

        .dark-mode .kwave-navbar,
        .dark-mode .kwave-navbar.scrolled {
            background: rgba(30, 26, 36, 0.96);
            border-bottom-color: #393240;
        }

        .dark-mode .nav-link {
            color: #e5deeb !important;
        }

        .dark-mode .theme-toggle {
            color: #eeeaf2;
            border-color: #554b60;
        }

        .dark-mode .theme-toggle:hover {
            background: #393040;
            color: #ff79bb;
        }

        .dark-mode .search-box,
        .dark-mode .category-btn {
            background: #26222e;
            color: #eeeaf2;
            border-color: #494151;
        }

        .dark-mode .search-box::placeholder {
            color: #aaa2b2;
        }

        .dark-mode .btn-login {
            color: #eeeaf2;
            border-color: #554b60;
        }

        .dark-mode .btn-login:hover {
            background: var(--pink);
            color: white;
        }

        .dark-mode .news-card,
        .dark-mode .related-card,
        .dark-mode .card,
        .dark-mode .dropdown-menu {
            background: #25212c;
            border-color: #403847;
            color: #eeeaf2;
        }

        .dark-mode .news-title,
        .dark-mode .related-card a,
        .dark-mode .section-title,
        .dark-mode h1,
        .dark-mode h2,
        .dark-mode h3,
        .dark-mode h4,
        .dark-mode h5,
        .dark-mode h6 {
            color: #eeeaf2;
        }

        .dark-mode .news-meta,
        .dark-mode .text-muted {
            color: #aaa2b2 !important;
        }

        .dark-mode .dropdown-item {
            color: #eeeaf2;
        }

        .dark-mode .dropdown-item:hover {
            background: #393040;
            color: white;
        }
        .dark-mode .form-control,
        .dark-mode .form-select,
        .dark-mode textarea {
            background-color: #26222e;
            border-color: #494151;
            color: #eeeaf2;
        }
        .dark-mode .form-control::placeholder,
        .dark-mode textarea::placeholder {
            color: #aaa2b2;
        }
        .dark-mode .table {
            --bs-table-bg: #25212c;
            --bs-table-color: #eeeaf2;
            --bs-table-border-color: #403847;
        }
        .dark-mode .alert {
            color: #eeeaf2;
        }
        .dark-mode .kwave-footer {
            background: #100e14;
        }
        .dark-mode hr {
            border-color: #554b60;
        }
        .dark-mode .navbar-toggler {
            border-color: #554b60;
        }
        .dark-mode .navbar-toggler-icon {
            filter: invert(1);
        }
        .btn-pink {
            background-color: var(--pink);
            border: 1px solid var(--pink);
            color: white;
            font-weight: 600;
            padding: 10px 16px;
        }
        .btn-pink:hover {
            background-color: #e52e89;
            border-color: #e52e89;
            color: white;
        }
        .btn-pink:focus {
            box-shadow: 0 0 0 3px rgba(255, 63, 159, 0.25);
        }
        .dark-mode .form-label,
        .dark-mode .form-check-label {
            color: #eeeaf2;
        }
        .dark-mode .form-check-input {
            background-color: #26222e;
            border-color: #706779;
        }
        .dark-mode .form-check-input:checked {
            background-color: var(--pink);
            border-color: var(--pink);
        }
        .dark-mode .alert-danger {
            background-color: #48252f;
            border-color: #773747;
            color: #ffc5d5;
        }
        .dark-mode .input-group .btn-outline-secondary {
            color: #eeeaf2;
            border-color: #554b60;
        }
        .dark-mode .input-group .btn-outline-secondary:hover {
            background-color: #393040;
            color: white;
        }
        .dark-mode .card a {
            color: #ff79bb;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg kwave-navbar">
        <div class="container py-2">

            <a class="kwave-logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-kwave.png') }}" alt="KWave">
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

                <button
                    type="button"
                    class="theme-toggle me-2"
                    id="themeToggle"
                    aria-label="Aktifkan mode gelap"
                    title="Mode gelap">
                    <i class="bi bi-moon"></i>
                </button>

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

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item rounded-3"
                                        href="{{ route('profile.edit') }}">
                                        Edit Profil
                                    </a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button
                                            type="submit"
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
                © {{ date('Y') }} KWave — Portal Berita K-Pop
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const kwaveNavbar = document.querySelector('.kwave-navbar');

        function updateKwaveNavbar() {
            if (!kwaveNavbar) return;

            kwaveNavbar.classList.toggle(
                'scrolled',
                window.scrollY > 20
            );
        }

        window.addEventListener('scroll', updateKwaveNavbar, {
            passive: true
        });

        updateKwaveNavbar();


        const newsCards = document.querySelectorAll('.news-card');

        if ('IntersectionObserver' in window) {
            const newsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    } else {
                        entry.target.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.12
            });

            newsCards.forEach(card => {
                card.classList.add('reveal-on-scroll');
                newsObserver.observe(card);
            });
        } else {
            newsCards.forEach(card => {
                card.classList.add('is-visible');
            });
        }


        const banner = document.querySelector('#bannerCarousel');

        if (banner && 'IntersectionObserver' in window) {
            const bannerObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        banner.classList.add('banner-visible');
                    } else {
                        banner.classList.remove('banner-visible');
                    }
                });
            }, {
                threshold: 0.15
            });

            bannerObserver.observe(banner);
        } else if (banner) {
            banner.classList.add('banner-visible');
        }


        const themeToggle = document.getElementById('themeToggle');

        if (themeToggle) {
            const themeIcon = themeToggle.querySelector('i');

            let savedTheme = localStorage.getItem('kwave-theme');
            let isDark = savedTheme === 'dark';

            function applyTheme() {
                document.body.classList.toggle('dark-mode', isDark);

                themeIcon.className = isDark
                    ? 'bi bi-sun'
                    : 'bi bi-moon';

                themeToggle.setAttribute(
                    'aria-label',
                    isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'
                );

                themeToggle.title = isDark
                    ? 'Mode terang'
                    : 'Mode gelap';
            }

            applyTheme();

            themeToggle.addEventListener('click', function () {
                isDark = !isDark;

                localStorage.setItem(
                    'kwave-theme',
                    isDark ? 'dark' : 'light'
                );

                applyTheme();
            });
        }
    </script>

</body>
</html>