@extends('layouts.app')

@section('title', 'KWave - Portal Berita K-Pop')

@section('content')

@if($banners->count())
    <div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner rounded-4 overflow-hidden">
            @foreach($banners as $i => $banner)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $banner->gambar) }}"
                         class="d-block w-100"
                         style="height:380px;object-fit:cover;"
                         alt="{{ $banner->berita->judul ?? 'KWave Featured News' }}">

                    <div class="carousel-caption text-start">
                        <span class="badge bg-dark mb-2">Featured</span>
                        <h2 class="fw-bold">{{ $banner->berita->judul ?? 'Berita K-Pop Terkini' }}</h2>

                        @if($banner->id_berita)
                            <a href="{{ route('berita.show', $banner->id_berita) }}"
                               class="btn btn-light btn-sm">
                                Baca Selengkapnya
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($banners->count() > 1)
            <button class="carousel-control-prev" type="button"
                    data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button"
                    data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        @endif
    </div>
@else
    <div class="p-5 mb-5 rounded-4 text-center"
         style="background:linear-gradient(135deg,#17121f,#8b5cf6);color:white;">
        <span class="badge bg-light text-dark mb-3">KWAVE</span>
        <h1 class="fw-bold">Latest K-Pop Updates</h1>
        <p class="mb-0">Berita terbaru seputar idol, musik, comeback, dan dunia K-Pop.</p>
    </div>
@endif

<div class="mb-5">
    <h2 class="section-title">Explore K-Pop</h2>

    <div class="category-menu">
        <a href="{{ route('home') }}"
           class="category-btn {{ !$idKategori ? 'active' : '' }}">
            Semua
        </a>

        @foreach($kategoris as $kat)
            <a href="{{ route('home', ['kategori' => $kat->id_kategori]) }}"
               class="category-btn {{ $idKategori == $kat->id_kategori ? 'active' : '' }}">
                {{ $kat->nama_kategori }}
            </a>
        @endforeach
    </div>
</div>

@if($keyword)
    <div class="mb-4">
        <p class="text-muted mb-1">Hasil pencarian untuk:</p>
        <h3 class="fw-bold">"{{ $keyword }}"</h3>
    </div>
@endif

<div class="mb-5">
    <h2 class="section-title">Latest News</h2>

    <div class="row g-4">
        @forelse($beritas as $berita)
            <div class="col-md-6 col-lg-4">
                <article class="news-card">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                             alt="{{ $berita->judul }}">
                    @else
                        <div style="height:210px;background:linear-gradient(135deg,#17121f,#8b5cf6);display:flex;align-items:center;justify-content:center;color:white;font-size:24px;font-weight:bold;">
                            KWave
                        </div>
                    @endif

                    <div class="news-card-body">
                        <span class="news-category">
                            {{ $berita->kategori->nama_kategori }}
                        </span>

                        <h3>
                            <a href="{{ route('berita.show', $berita->id_berita) }}"
                               class="news-title">
                                {{ $berita->judul }}
                            </a>
                        </h3>

                        <div class="news-meta">
                            {{ $berita->tanggal?->translatedFormat('d M Y') }}
                            · {{ $berita->views }} views
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="bg-white rounded-4 p-5 text-center">
                    <h4>Belum ada berita</h4>
                    <p class="text-muted mb-0">Berita K-Pop akan muncul di sini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="d-flex justify-content-center">
    {{ $beritas->links() }}
</div>

@endsection