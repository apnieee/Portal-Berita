
@extends('layouts.app')

@section('title', 'Profil ' . $author->nama . ' - KWave')

@section('content')

<style>
    .author-profile-page {
        max-width: 1050px;
        margin: auto;
    }

    .author-hero {
        background: var(--surface);
        color: var(--text);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .author-cover {
        height: 75px;
        background: linear-gradient(120deg, var(--pink), var(--purple));
    }

    .author-profile-content {
        padding: 35px 30px;
        text-align: center;
    }

    .author-profile-avatar,
    .author-profile-initial {
        width: 115px;
        height: 115px;
        border-radius: 50%;
        border: 3px solid var(--surface);
    }

    .author-profile-avatar {
        object-fit: cover;
    }

    .author-profile-label {
        display: inline-block;
        color: var(--accent-text);
        background: var(--accent-soft);
        padding: 7px 15px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
    }

    .author-profile-initial {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--pink);
        color: white;
        font-size: 40px;
        font-weight: 700;
    }

    .author-profile-name {
        color: var(--text);
        font-size: 26px;
        font-weight: 750;
        margin-top: 16px;
        margin-bottom: 8px;
    }

    .author-profile-bio {
        max-width: 620px;
        margin: 20px auto;
        line-height: 1.8;
        color: var(--muted);
    }

    .author-stat {
        display: inline-block;
        min-width: 170px;
        margin-top: 10px;
        padding: 14px 25px;
        background: var(--accent-soft);
        border: 1px solid var(--border);
        border-radius: 10px;
    }

    .author-stat h3 {
        color: var(--accent-text);
        font-weight: 800;
        margin-bottom: 3px;
    }

    .author-news-heading {
        color: var(--text);
        font-weight: 800;
        margin-bottom: 6px;
    }

    .author-news-subtitle {
        color: var(--muted);
        margin-bottom: 25px;
    }

    .author-news-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: var(--surface);
        color: var(--text);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .author-news-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow);
    }

    .author-news-image,
    .author-news-placeholder {
        width: 100%;
        height: 205px;
    }

    .author-news-image {
        object-fit: cover;
    }

    .author-news-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--accent-soft);
        color: var(--accent-text);
        font-size: 30px;
        font-weight: 800;
    }

    .author-news-title {
        color: var(--text);
        font-size: 17px;
        font-weight: 700;
        line-height: 1.5;
    }

    .author-news-excerpt {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
    }

    .author-read-button {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 6px;
        background: var(--pink);
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: background .2s ease;
    }

    .author-read-button:hover {
        background: var(--purple);
        color: white;
    }

    @media (max-width: 576px) {
        .author-profile-content {
            padding: 28px 18px;
        }

        .author-profile-avatar,
        .author-profile-initial {
            width: 100px;
            height: 100px;
        }

        .author-profile-name {
            font-size: 23px;
        }
    }
</style>

<div class="container py-5 author-profile-page">

    <div class="author-hero mb-5">
        <div class="author-cover"></div>
        <div class="author-profile-content">

            @if ($author->foto_profil)
                <img
                    src="{{ asset('storage/' . $author->foto_profil) }}"
                    alt="Foto {{ $author->nama }}"
                    class="author-profile-avatar">
            @else
                <div class="author-profile-initial">
                    {{ strtoupper(substr($author->nama, 0, 1)) }}
                </div>
            @endif

            <h2 class="author-profile-name">
                {{ $author->nama }}
            </h2>

            <span class="author-profile-label">
                Author KWave
            </span>

            <p class="author-profile-bio">
                {{ $author->bio ?: 'Author KWave yang berbagi informasi seputar dunia K-Pop.' }}
            </p>

            <div class="author-stat">
                <h3>{{ $totalBerita }}</h3>
                <small class="text-muted">Berita diterbitkan</small>
            </div>

        </div>
    </div>

    <div class="mb-4">
        <h3 class="author-news-heading">
            Berita oleh {{ $author->nama }}
        </h3>

        <p class="author-news-subtitle">
            Temukan berbagai artikel yang telah ditulis oleh Author ini.
        </p>
    </div>

    <div class="row g-4">
        @forelse ($beritas as $berita)
            <div class="col-md-6 col-lg-4">

                <div class="author-news-card">

                    @if ($berita->gambar)
                        <img
                            src="{{ asset('storage/' . $berita->gambar) }}"
                            class="author-news-image"
                            alt="{{ $berita->judul }}">
                    @else
                        <div class="author-news-placeholder">
                            KW
                        </div>
                    @endif

                    <div class="p-3">

                        <h5 class="author-news-title">
                            {{ $berita->judul }}
                        </h5>

                        <p class="author-news-excerpt mb-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 110) }}
                        </p>

                        <a
                            href="{{ route('berita.show', $berita->id_berita) }}"
                            class="author-read-button">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        @empty

            <div class="col-12">
                <div class="text-center py-5">
                    <h5 class="fw-bold">Belum Ada Berita</h5>
                    <p class="text-muted">
                        Author ini belum menerbitkan berita.
                    </p>
                </div>
            </div>

        @endforelse
    </div>

    <div class="mt-4">
        {{ $beritas->links() }}
    </div>

</div>
@endsection
