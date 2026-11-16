
@extends('layouts.app')

@section('title', $term->term . ' - K-Pop Dictionary')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <a href="{{ route('dictionary.index') }}"
           class="text-decoration-none"
           style="color:var(--accent-text);">
            ← Kembali Ke Kamus
        </a>
    </div>

    <article class="mx-auto" style="max-width:850px;">

        <div class="mb-3">
            @if($term->category)
                <span class="news-category">
                    {{ $term->category }}
                </span>
            @endif
        </div>

        <h1 class="fw-bold mb-4">{{ $term->term }}</h1>

        <div class="news-card p-4 p-md-5">

            <h2 class="h5 fw-bold mb-3">Apa artinya?</h2>

            <p style="line-height:1.9;color:var(--text);">
                {{ $term->meaning }}
            </p>

            @if($term->example)
                <hr style="border-color:var(--border);">

                <h2 class="h5 fw-bold mb-3">Contoh Penggunaan</h2>

                <p class="mb-0" style="line-height:1.9;color:var(--muted);">
                    {{ $term->example }}
                </p>
            @endif

        </div>

    </article>

</div>
@endsection