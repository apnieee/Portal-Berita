
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

            --bg: #faf9fc;
            --surface: #ffffff;
            --surface-alt: #f5f1f8;
            --text: #25202b;
            --muted: #77717d;
            --border: #eee8f2;
            --accent-soft: #fce7f3;
            --accent-text: #e92e8b;
            --shadow: 0 10px 25px rgba(30, 20, 40, 0.08);

            color-scheme: light;
            --bs-body-color: var(--text);
            --bs-body-bg: var(--bg);
            --bs-border-color: var(--border);
            --bs-secondary-color: var(--muted);
            --bs-tertiary-bg: var(--surface-alt);
            --bs-emphasis-color: var(--text);
            --bs-card-bg: var(--surface);
        }

        body.dark-mode {
            --bg: #17151c;
            --surface: #25212c;
            --surface-alt: #302a38;
            --text: #eeeaf2;
            --muted: #aaa2b2;
            --border: #403847;
            --accent-soft: #393040;
            --accent-text: #ff79bb;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.2);

            color-scheme: dark;
            --bs-body-color: var(--text);
            --bs-body-bg: var(--bg);
            --bs-border-color: var(--border);
            --bs-secondary-color: var(--muted);
            --bs-tertiary-bg: var(--surface-alt);
            --bs-emphasis-color: var(--text);
            --bs-card-bg: var(--surface);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            transition: background 0.3s ease, color 0.3s ease;
        }

        main {
            min-height: 75vh;
        }

        .kwave-navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        .kwave-navbar.scrolled {
            background: var(--surface);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
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

        .nav-link {
            color: var(--text) !important;
            font-weight: 600;
            margin: 0 4px;
        }

        .nav-link:hover {
            color: var(--pink) !important;
        }

        .navbar-toggler {
            border-color: var(--border);
        }

        .navbar-toggler-icon {
            filter: none;
        }

        .dark-mode .navbar-toggler-icon {
            filter: invert(1);
        }

        .search-box {
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 8px 15px;
            background: var(--surface-alt);
            color: var(--text);
        }

        .search-box::placeholder {
            color: var(--muted);
        }

        .search-box:focus {
            background: var(--surface);
            color: var(--text);
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
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 7px 16px;
            color: var(--text);
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
            border: 2px solid var(--accent-soft);
            border-radius: 50%;
            overflow: hidden;
            background: var(--accent-soft);
            color: var(--pink);
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
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(255, 63, 159, 0.12);
        }

        .profile-avatar:focus-visible {
            outline: 2px solid var(--pink);
            outline-offset: 3px;
        }

        .theme-toggle {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 50%;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            font-size: 17px;
            transition: 0.2s ease;
            flex-shrink: 0;
        }

        .theme-toggle:hover {
            background: var(--accent-soft);
            color: var(--pink);
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
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
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

        .news-card,
        .related-card,
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--text);
        }

        .news-card {
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            transition: 0.2s ease;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
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
            box-shadow: var(--shadow);
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
            background: var(--accent-soft);
            color: var(--accent-text);
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
            color: var(--text);
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

        .author-card,
        .author-empty {
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--text);
        }

        .author-card {
            height: 100%;
            min-height: 215px;
            padding: 25px 18px;
            border-radius: 18px;
            text-align: center;
            transition: 0.25s ease;
        }

        .author-card:hover {
            transform: translateY(-5px);
            border-color: var(--pink);
            box-shadow: var(--shadow);
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
            background: var(--pink);
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
            text-align: center;
            color: var(--muted);
        }

        .radar-date {
            background: var(--accent-soft);
            min-width: 80px;
            flex-shrink: 0;
        }

        .radar-date-number {
            color: var(--purple);
        }

        .radar-date-month {
            color: var(--muted);
            font-size: 11px;
        }

        .dropdown-menu {
            background: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }

        .dropdown-item {
            color: var(--text);
        }

        .dropdown-item:hover {
            background: var(--surface-alt);
            color: var(--pink);
        }

        .text-muted {
            color: var(--muted) !important;
        }

        .form-control,
        .form-select,
        textarea {
            background-color: var(--surface);
            border-color: var(--border);
            color: var(--text);
        }

        .form-control::placeholder,
        textarea::placeholder {
            color: var(--muted);
        }

        .form-control:focus,
        .form-select:focus,
        textarea:focus {
            background-color: var(--surface);
            color: var(--text);
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(255, 63, 159, 0.1);
        }

        .form-label,
        .form-check-label {
            color: var(--text);
        }

        .form-check-input {
            background-color: var(--surface);
            border-color: var(--muted);
        }

        .form-check-input:checked {
            background-color: var(--pink);
            border-color: var(--pink);
        }

        .table {
            --bs-table-bg: var(--surface);
            --bs-table-color: var(--text);
            --bs-table-border-color: var(--border);
        }

        .alert {
            color: var(--text);
        }

        .alert-danger {
            background-color: #48252f;
            border-color: #773747;
            color: #ffc5d5;
        }

        .input-group .btn-outline-secondary {
            color: var(--text);
            border-color: var(--border);
        }

        .input-group .btn-outline-secondary:hover {
            background-color: var(--surface-alt);
            color: var(--text);
        }

        .card a {
            color: var(--pink);
        }

        hr {
            border-color: var(--border);
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

        @media (max-width: 768px) {
            .kwave-logo img {
                height: 90px;
                width: 90px;
            }

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

        @media (prefers-reduced-motion: reduce) {
            .news-card.reveal-on-scroll,
            .news-card.reveal-on-scroll.is-visible {
                opacity: 1;
                transform: none;
                transition: none;
            }

            #bannerCarousel,
            #bannerCarousel .carousel-caption .badge,
            #bannerCarousel .carousel-caption h2,
            #bannerCarousel .carousel-caption a {
                animation: none;
            }
        }

        .modal-content,
        .offcanvas {
            background: var(--surface);
            color: var(--text);
            border-color: var(--border);
        }

        .modal-header,
        .modal-footer {
            border-color: var(--border);
        }

        .accordion-item {
            background: var(--surface);
            color: var(--text);
            border-color: var(--border);
        }

        .accordion-button {
            background: var(--surface);
            color: var(--text);
        }

        .accordion-button:not(.collapsed) {
            background: var(--accent-soft);
            color: var(--accent-text);
        }

        .accordion-button::after {
            filter: none;
        }

        .dark-mode .accordion-button::after {
            filter: invert(1);
        }

        .list-group-item {
            background: var(--surface);
            color: var(--text);
            border-color: var(--border);
        }

        .page-link {
            background: var(--surface);
            color: var(--text);
            border-color: var(--border);
        }

        .page-link:hover {
            background: var(--accent-soft);
            color: var(--pink);
            border-color: var(--pink);
        }

        .page-item.active .page-link {
            background: var(--pink);
            border-color: var(--pink);
            color: white;
        }

        .page-item.disabled .page-link {
            background: var(--surface-alt);
            color: var(--muted);
        }

        .toast {
            background: var(--surface);
            color: var(--text);
            border-color: var(--border);
        }

        .toast-header {
            background: var(--surface-alt);
            color: var(--text);
            border-color: var(--border);
        }

        .progress {
            background: var(--surface-alt);
        }

        .progress-bar {
            background: var(--pink);
        }

        a:not(.btn):not(.nav-link):not(.dropdown-item) {
            transition: color 0.2s ease;
        }

        ::selection {
            background: var(--pink);
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg kwave-navbar">
        <div class="container py-2">

            <a class="kwave-logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-kwave.png') }}" alt="KWave">
            </a>

            <div class="collapse navbar-collapse order-2 order-lg-1" id="kwaveNav">
                <ul class="navbar-nav ms-lg-4 me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dictionary.index') }}">
                            Dictionary
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
            </div>

            <div class="d-flex align-items-center ms-auto order-1 order-lg-2">
                <button
                    type="button"
                    class="theme-toggle me-2"
                    id="themeToggle"
                    aria-label="Aktifkan mode gelap"
                    title="Mode gelap">
                    <i class="bi bi-moon"></i>
                </button>

                @auth
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
                                @if(auth()->user()->role === 'admin')
                                    <a class="dropdown-item rounded-3" href="{{ url('/admin') }}">
                                        Dashboard Admin
                                    </a>
                                @elseif(auth()->user()->role === 'author')
                                    <a class="dropdown-item rounded-3" href="{{ url('/author') }}">
                                        Dashboard Author
                                    </a>
                                @else
                                    <a class="dropdown-item rounded-3" href="{{ route('profile.edit') }}">
                                        Edit Profil
                                    </a>
                                @endif
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
                @else
                    <a href="{{ route('login') }}" class="btn-login me-2">
                        Login
                    </a>
                @endauth

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