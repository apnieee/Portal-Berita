@extends('layouts.admin')
@section('title', 'Tambah Berita')

@section('content')
<h3>Tambah Berita</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
    </div>
@endif
<form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="bg-white p-3 rounded">
    @csrf
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="id_kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kat)
                <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Isi Berita</label>
        <textarea name="isi" rows="8" class="form-control" required>{{ old('isi') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Gambar</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" name="featured" value="1" class="form-check-input" id="featured">
        <label class="form-check-label" for="featured">Jadikan berita unggulan (featured)</label>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
