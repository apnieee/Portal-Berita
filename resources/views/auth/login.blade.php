
@extends('layouts.app')
@section('title', 'Login - KWave')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <h4 class="mb-3">Login</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required
                        autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">
                        Password
                    </label>

                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            autocomplete="current-password"
                            required>

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            id="toggleLoginPassword">
                            Tampilkan
                        </button>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input
                        type="checkbox"
                        name="remember"
                        class="form-check-input"
                        id="remember">

                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button class="btn btn-pink w-100" type="submit">
                    Login
                </button>
            </form>

            <p class="mt-3 mb-0">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar</a>
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('toggleLoginPassword');
    const password = document.getElementById('password');

    if (!button || !password) return;

    button.addEventListener('click', function () {
        const visible = password.type === 'password';

        password.type = visible ? 'text' : 'password';
        button.textContent = visible ? 'Sembunyikan' : 'Tampilkan';
    });
});
</script>
@endsection
