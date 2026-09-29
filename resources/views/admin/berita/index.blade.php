@extends('layouts.admin')
@section('title', 'Kelola Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Berita</h3>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">+ Tambah Berita</a>
</div>

<form method="GET" class="mb-3">
    <input type="search" name="q" class="form-control" placeholder="Cari judul/isi berita..." value="{{ $keyword }}">
</form>

<table class="table table-bordered bg-white align-middle">
    <thead>
        <tr>
            <th>#</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Status</th><th>Views</th><th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($beritas as $b)
        <tr>
            <td>{{ $b->id_berita }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->kategori->nama_kategori }}</td>
            <td>{{ $b->user->nama }}</td>
            <td>
                <span class="badge {{ $b->status === 'published' ? 'bg-success' : 'bg-secondary' }}">{{ $b->status }}</span>
            </td>
            <td>{{ $b->views }}</td>
            <td>
                <a href="{{ route('admin.berita.edit', $b->id_berita) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.berita.destroy', $b->id_berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus berita ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">Belum ada berita.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $beritas->links() }}
@endsection
