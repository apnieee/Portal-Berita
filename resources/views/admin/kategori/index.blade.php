@extends('layouts.admin')
@section('title', 'Kelola Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kategori</h3>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<form method="GET" class="mb-3">
    <input type="search" name="q" class="form-control" placeholder="Cari kategori..." value="{{ $keyword }}">
</form>

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>#</th><th>Nama Kategori</th><th width="150">Aksi</th></tr>
    </thead>
    <tbody>
        @forelse($kategoris as $k)
        <tr>
            <td>{{ $k->id_kategori }}</td>
            <td>{{ $k->nama_kategori }}</td>
            <td>
                <a href="{{ route('admin.kategori.edit', $k->id_kategori) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3" class="text-center">Belum ada kategori.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $kategoris->links() }}
@endsection
