@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<h3>Edit Kategori</h3>
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" class="bg-white p-3 rounded">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
