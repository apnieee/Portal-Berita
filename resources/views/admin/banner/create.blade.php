@extends('layouts.admin')
@section('title', 'Tambah Banner')

@section('content')
<h3>Tambah Banner</h3>
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data" class="bg-white p-3 rounded">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul (opsional)</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Gambar</label>
        <input type="file" name="gambar" class="form-control" accept="image/*" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
