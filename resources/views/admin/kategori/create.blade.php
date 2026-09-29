@extends('layouts.admin')
@section('title', 'Tambah Kategori')

@section('content')
<h3>Tambah Kategori</h3>
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('admin.kategori.store') }}" class="bg-white p-3 rounded">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
