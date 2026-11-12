
@extends('layouts.app')

@section('title', 'Profil ' . $author->nama . ' - KWave')

@section('content')
<div class="container py-5">

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-4 p-md-5 text-center">

            @if ($author->foto_profil)
                <img
                    src="{{ asset('storage/' . $author->foto_profil) }}"
                    alt="Foto {{ $author->nama }}"
                    class="rounded-circle mb-3"
                    width="120"
                    height="120"
                    style="object-fit: cover;">
            @else
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                    style="width:120px;height:120px;background:#fce7f3;color:#ff3f9f;font-size:42px;font-weight:bold;">
                    {{ strtoupper(substr($author->nama, 0, 1)) }}
                </div>
            @endif

            <h2 class="fw-bold">{{ $author->nama }}</h2>
            <span class="badge rounded-pill text-bg-light mb-3">
                Author KWave
            </span>

            <p class="text-muted mx-auto" style="max-width:600px;">
                {{ $author->bio ?: 'Author KWave yang berbagi informasi seputar dunia K-Pop.' }}
            </p>

            <div class="mt-4">
                <h4 class="fw-bold mb-0">{{ $totalBerita }}</h4>
                <small class="text-muted">Berita diterbitkan</small>
            </div>

        </div>
    </div>

    <h3 class="fw-bold mb-4">Berita oleh {{ $author->nama }}</h3>

    <div class="row g-4">
        @forelse ($beritas as $berita)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                    @if ($berita->gambar)
                        <img
                            src="{{ asset('storage/' . $berita->gambar) }}"
                            class="card-img-top"
                            alt="{{ $berita->judul }}"
                            style="height:200px;object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="fw-bold">
                            {{ $berita->judul }}
                        </h5>

                        <p class="text-muted small">
                            {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 100) }}
                        </p>

                        <a href="{{ route('berita.show', $berita->id_berita) }}"
                            class="btn btn-sm text-white"
                            style="background:#ff3f9f;">
                            Baca Berita
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">
                    Author ini belum menerbitkan berita.
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $beritas->links() }}
    </div>

</div>
@endsection
