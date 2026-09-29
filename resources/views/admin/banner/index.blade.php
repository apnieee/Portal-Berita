@extends('layouts.admin')
@section('title', 'Kelola Banner')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Banner</h3>
    <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">+ Tambah Banner</a>
</div>

<table class="table table-bordered bg-white align-middle">
    <thead>
        <tr><th>#</th><th>Preview</th><th>Judul</th><th>Status</th><th width="150">Aksi</th></tr>
    </thead>
    <tbody>
        @forelse($banners as $b)
        <tr>
            <td>{{ $b->id_banner }}</td>
            <td><img src="{{ asset('storage/' . $b->gambar) }}" style="height:60px;"></td>
            <td>{{ $b->judul }}</td>
            <td><span class="badge {{ $b->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">{{ $b->status }}</span></td>
            <td>
                <a href="{{ route('admin.banner.edit', $b->id_banner) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.banner.destroy', $b->id_banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus banner ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Belum ada banner.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $banners->links() }}
@endsection
