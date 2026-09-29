@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<h3>Dashboard</h3>
<div class="row g-3 mt-2">
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h2>{{ \App\Models\Berita::count() }}</h2>
            <span>Total Berita</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h2>{{ \App\Models\Kategori::count() }}</h2>
            <span>Kategori</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h2>{{ \App\Models\Banner::count() }}</h2>
            <span>Banner</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <h2>{{ \App\Models\User::count() }}</h2>
            <span>User Terdaftar</span>
        </div>
    </div>
</div>
@endsection
