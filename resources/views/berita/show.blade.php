@extends('layouts.app')
@section('title', $berita->judul . ' - KWave')

@section('content')

<style>
    .news-detail {
        max-width: 1200px;
        margin: 0 auto;
        transition: color 0.3s ease;
    }

    .news-category {
        display: inline-block;
        background: var(--accent-soft);
        color: var(--accent-text);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        margin-bottom: 12px;
    }

    .news-title {
        font-size: 2.3rem;
        line-height: 1.2;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text);
    }

    .news-meta {
        color: var(--muted);
        font-size: 0.9rem;
        margin-bottom: 24px;
    }

    .news-cover {
        width: 100%;
        max-height: 520px;
        object-fit: cover;
        border-radius: 16px;
        display: block;
        margin-bottom: 28px;
    }

    .article-content {
        font-size: 1.05rem;
        line-height: 1.85;
        color: var(--text);
    }

    .article-content p {
        margin-bottom: 1.2rem;
    }

    .article-content h2 {
        font-size: 1.7rem;
        margin-top: 2.2rem;
        margin-bottom: 1rem;
        font-weight: 700;
        color: var(--text);
    }

    .article-content h3 {
        font-size: 1.4rem;
        margin-top: 1.8rem;
        margin-bottom: 0.8rem;
        font-weight: 700;
        color: var(--text);
    }

    .article-content ul,
    .article-content ol {
        margin-bottom: 1.2rem;
        padding-left: 1.8rem;
    }

    .article-content li {
        margin-bottom: 0.4rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 2rem auto;
        border-radius: 12px;
    }

    .article-content blockquote {
        border-left: 4px solid var(--pink);
        padding: 12px 20px;
        margin: 1.8rem 0;
        background: var(--surface-alt);
        color: var(--muted);
        font-style: italic;
        border-radius: 0 8px 8px 0;
    }

    .related-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--text);
    }

    .related-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: 0.2s ease;
    }

    .related-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .related-card a {
        display: block;
        padding: 14px 16px;
        text-decoration: none;
        color: var(--text);
        font-weight: 600;
        line-height: 1.5;
    }

    .related-card .text-muted {
        padding: 0 16px 12px;
        margin-top: 4px !important;
        display: block;
    }

    .back-button {
        margin-top: 32px;
    }

    @media (max-width: 768px) {
        .news-title {
            font-size: 1.8rem;
        }

        .news-cover {
            max-height: 350px;
        }

        .article-content {
            font-size: 1rem;
        }
    }

    .theme-toggle {
        width: 40px;
        height: 40px;
        border: 1px solid var(--border);
        border-radius: 50%;
        background: transparent;
        color: var(--text);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .theme-toggle:hover {
        background: var(--accent-soft);
        color: var(--accent-text);
    }

    body.dark-mode .back-button {
        color: #f8f9fa;
        border-color: #adb5bd;
    }

    body.dark-mode .back-button:hover {
        background-color: #f8f9fa;
        color: #212529;
    }
</style>

<div class="news-detail py-4">

    <div class="row g-5">

        <div class="col-lg-8">
            @foreach($berita->kategoris as $kat)
                <span class="news-category">
                    {{ $kat->nama_kategori }}
                </span>
            @endforeach

            <h1 class="news-title">
                {{ $berita->judul }}
            </h1>

            <div class="news-meta">
                Oleh <strong>{{ $berita->user->nama }}</strong>
                &nbsp;·&nbsp;
                {{ $berita->tanggal?->translatedFormat('d M Y, H:i') }}
                &nbsp;·&nbsp;
                {{ $berita->views }} views
            </div>

            @if($berita->gambar)
                <img
                    src="{{ asset('storage/' . $berita->gambar) }}"
                    alt="{{ $berita->judul }}"
                    class="news-cover"
                >
            @endif

            <article class="article-content">
                {!! $berita->isi !!}
            </article>

            <a href="{{ url('/') }}" class="btn btn-outline-dark back-button">
                ← Kembali ke Beranda
            </a>

        </div>

        <div class="col-lg-4">

            <div class="related-title">
                Berita Terkait
            </div>

            @forelse($terkait as $t)

                <div class="related-card mb-3">
                    <div class="card-body">
                        <a href="{{ route('berita.show', $t->id_berita) }}">
                            {{ $t->judul }}
                        </a>

                        <div class="text-muted small mt-2">
                            {{ $t->tanggal?->translatedFormat('d M Y') }}
                        </div>
                    </div>
                </div>

            @empty

                <p class="text-muted">
                    Tidak ada berita terkait.
                </p>

            @endforelse

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.news-detail');
    const toggle = document.getElementById('themeToggle');
    const icon = toggle.querySelector('i');

    //ambil tema yang tersimpan
    let darkMode = localStorage.getItem('kwave-news-theme') === 'dark';

    function applyTheme() {
        container.classList.toggle('dark-mode', darkMode);

        icon.className = darkMode
            ? 'bi bi-sun'
            : 'bi bi-moon';

        toggle.setAttribute(
            'aria-label',
            darkMode ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'
        );
    }

    applyTheme();

    toggle.addEventListener('click', function () {
        darkMode = !darkMode;

        localStorage.setItem(
            'kwave-news-theme',
            darkMode ? 'dark' : 'light'
        );

        applyTheme();
    });
});
</script>

@endsection