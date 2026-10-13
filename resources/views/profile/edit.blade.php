@extends('layouts.app')

@section('title', 'Profil Saya - KWave')

@section('content')
<div class="container py-4" style="max-width: 720px;">
    <h2 class="fw-bold mb-1">Profil Saya</h2>
    <p class="text-muted mb-4">Kelola informasi akun KWave kamu.</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                     style="width: 80px; height: 80px; background: #fce7f3; color: #ff3f9f; font-size: 32px; font-weight: bold;">
                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                </div>

                <h4 class="mt-3">{{ $user->nama }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama"
                           class="form-control"
                           value="{{ old('nama', $user->nama) }}"
                           maxlength="100" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}"
                           maxlength="100" required>
                </div>

                <button type="submit" class="btn text-white w-100"
                        style="background: #ff3f9f;">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection