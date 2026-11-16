
@extends('layouts.app')

@section('title', 'K-Pop Dictionary - KWave')

@section('content')
<div class="container py-5">

    <div class="mb-5">
        <span class="text-uppercase fw-bold"
              style="font-size:12px;letter-spacing:2px;color:var(--accent-text);">
            Jelajahi Budaya K-Pop
        </span>

        <h1 class="fw-bold mt-2">K-Pop Dictionary</h1>

        <p class="text-muted">
            Mengenal istilah dan budaya K-Pop, satu kata dalam satu waktu.
        </p>
    </div>

    <form action="{{ route('dictionary.index') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-7">
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="Cari istilah K-Pop..."
                    value="{{ $keyword }}"
                >
            </div>

            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>

                    @foreach($categories as $item)
                        <option value="{{ $item }}"
                            {{ $category === $item ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn w-100"
                        style="background:var(--pink);color:white;">
                    Cari
                </button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($terms as $item)
            <div class="col-md-6 col-lg-4">
                <article class="news-card h-100 p-4">
                    <div class="mb-3">
                        @if($item->category)
                            <span class="news-category">
                                {{ $item->category }}
                            </span>
                        @endif
                    </div>

                    <h3 class="h5 fw-bold mb-2">
                        {{ $item->term }}
                    </h3>

                    <p class="text-muted mb-3">
                        {{ \Illuminate\Support\Str::limit($item->meaning, 120) }}
                    </p>

                    <a href="{{ route('dictionary.show', $item->slug) }}"
                       class="news-title">
                        Pelajari lebih lanjut →
                    </a>
                </article>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5>Belum ada istilah ditemukan.</h5>
                <p class="text-muted">
                    Coba kata kunci lain atau periksa kembali nanti.
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $terms->links() }}
    </div>

</div>
@endsection