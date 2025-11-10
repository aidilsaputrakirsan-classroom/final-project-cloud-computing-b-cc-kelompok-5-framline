@extends('layouts.app')

@section('title', 'Buat Akun')

@push('styles')
<style>
    body {
        margin: 0;
        padding: 0;
        background: #000; /* FULL cinema black */
        font-family: 'Inter', sans-serif;
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding-top: 60px;
    }

    /* --- HEADER --- */
    .register-header {
        width: 100%;
        max-width: 420px;
        text-align: left;
        margin-bottom: 30px;
    }

    .register-logo {
        font-size: 2rem;
        font-weight: 800;
        color: #e50914; /* Netflix Red */
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .register-title {
        font-size: 1.45rem;
        font-weight: 600;
        margin-top: 8px;
        color: #f5f5f5;
    }

    /* --- CONTAINER BOX --- */
    .register-box {
        width: 100%;
        max-width: 420px;
        background: rgba(20, 20, 20, 0.9);
        border-radius: 12px;
        padding: 40px 35px;
        box-shadow: 0 0 35px rgba(0,0,0,0.6);
        backdrop-filter: blur(8px);
    }

    /* --- INPUT --- */
    .form-control {
        width: 100%;
        height: 48px;
        border-radius: 6px;
        background: #333;
        border: 1px solid #444;
        color: #fff;
        font-size: 1rem;
        padding: 12px 15px;
        margin-bottom: 18px;
        transition: all 0.25s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #e50914;
        background: #222;
        box-shadow: 0 0 8px rgba(229, 9, 20, 0.5);
    }

    /* --- BUTTON --- */
    .btn-register {
        background: #e50914;
        color: #fff;
        border: none;
        height: 50px;
        width: 100%;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1.05rem;
        cursor: pointer;
        letter-spacing: .5px;
        transition: background 0.25s ease;
    }

    .btn-register:hover {
        background: #b20710;
    }

    /* --- FOOTER --- */
    .login-footer {
        text-align: center;
        margin-top: 20px;
        font-size: .95rem;
        color: #bbb;
    }

    .login-footer a {
        color: #e50914;
        font-weight: 600;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }

</style>
@endpush

@section('content')
<div>

    <div class="register-header">
        <div class="register-logo">CINEMA XXI</div>
        <div class="register-title">Buat akun m.tix kamu</div>
    </div>

    <div class="register-box">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Nama Lengkap" required autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email" required>

            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <input id="password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Kata Sandi" required>

            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <input id="password-confirm" type="password" name="password_confirmation"
                class="form-control" placeholder="Konfirmasi Kata Sandi" required>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="login-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

</div>
@endsection
