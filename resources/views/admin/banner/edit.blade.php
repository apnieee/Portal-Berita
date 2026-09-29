@extends('layouts.admin')
@section('title', 'Edit Banner')

@section('content')
<h3>Edit Banner</h3>
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('admin.banner.update', $banner->id_banner) }}" enctype="multipart/form-data" class="bg-white p-3 rounded">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Judul (opsional)</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $banner->judul) }}">
    </div>
    <img src="{{ asset('storage/' . $banner->gambar) }}" class="mb-2 d-block" style="max-height:120px;">
    <div class="mb-3">
        <label class="form-label">Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="aktif" {{ $banner->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ $banner->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
