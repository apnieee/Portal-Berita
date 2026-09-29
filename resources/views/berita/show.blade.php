@extends('layouts.app')
@section('title', $berita->judul . ' - KWave')

@section('content')
<div class="row">
    <div class="col-md-8">
        <span class="badge bg-secondary mb-2">{{ $berita->kategori->nama_kategori }}</span>
        <h2>{{ $berita->judul }}</h2>
        <p class="text-muted small">
            Oleh {{ $berita->user->nama }} &middot; {{ $berita->tanggal?->translatedFormat('d M Y, H:i') }} &middot; {{ $berita->views }} views
        </p>
        @if($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded mb-3">
        @endif
        <div class="mt-3" style="white-space: pre-line;">{{ $berita->isi }}</div>
    </div>
    <div class="col-md-4">
        <h5>Berita Terkait</h5>
        @forelse($terkait as $t)
            <div class="card mb-2">
                <div class="card-body">
                    <a href="{{ route('berita.show', $t->id_berita) }}">{{ $t->judul }}</a>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada berita terkait.</p>
        @endforelse
    </div>
</div>
@endsection
