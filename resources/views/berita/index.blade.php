@extends('layouts.app')
@section('title', 'KWave - Update K-Pop Terkini')

@section('content')

@if($banners->count())
<div id="bannerCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner rounded">
        @foreach($banners as $i => $banner)
        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
            <img src="{{ asset('storage/' . $banner->gambar) }}" class="d-block w-100" style="max-height:350px;object-fit:cover;" alt="{{ $banner->judul }}">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif

<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('home') }}" class="btn btn-sm {{ !$idKategori ? 'btn-pink' : 'btn-outline-light' }}">Semua</a>
            @foreach($kategoris as $kat)
                <a href="{{ route('home', ['kategori' => $kat->id_kategori]) }}"
                   class="btn btn-sm {{ $idKategori == $kat->id_kategori ? 'btn-pink' : 'btn-outline-light' }}">
                    {{ $kat->nama_kategori }}
                </a>
            @endforeach
        </div>
    </div>
</div>

@if($keyword)
    <p>Hasil pencarian untuk: <strong>"{{ $keyword }}"</strong></p>
@endif

<div class="row g-4">
    @forelse($beritas as $berita)
        <div class="col-md-4">
            <div class="card h-100">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-secondary mb-2 align-self-start">{{ $berita->kategori->nama_kategori }}</span>
                    <h5 class="card-title"><a href="{{ route('berita.show', $berita->id_berita) }}">{{ $berita->judul }}</a></h5>
                    <p class="card-text small text-muted mt-auto">
                        {{ $berita->tanggal?->translatedFormat('d M Y') }} &middot; {{ $berita->views }} views
                    </p>
                </div>
            </div>
        </div>
    @empty
        <p>Belum ada berita.</p>
    @endforelse
</div>

<div class="mt-4">
    {{ $beritas->links() }}
</div>

@endsection
