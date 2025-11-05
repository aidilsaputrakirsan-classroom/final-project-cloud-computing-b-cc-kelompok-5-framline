@extends('layouts.app')

@section('title', 'Buat Akun')

@push('styles')
<style>
    body {
        background: linear-gradient(180deg, #ffffff 0%, #e8f9fa 100%);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 100px; /* 🔽 ini untuk menurunkan posisi konten */
    }

    .register-header {
        width: 100%;
        max-width: 600px;
        text-align: left;
        margin-bottom: 25px;
    }

    .register-logo {
        font-family: "Playfair Display", serif;
        font-size: 1.8rem;
        font-weight: bold;
        color: #000;
        margin-bottom: 10px;
    }

    .register-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #222;
        margin-top: 10px;
    }

    .register-box {
        width: 100%;
        max-width: 600px;
        background: #f9ffff;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .form-control {
        width: 100%;
        height: 48px;
        border: 1px solid #cce7e8;
        border-radius: 8px;
        background: #f2fcfc;
        font-size: 1rem;
        padding: 10px 15px;
        margin-bottom: 20px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #00897b;
        background: #ffffff;
    }

    .btn-register {
        background: #00897b;
        color: white;
        border: none;
        height: 50px;
        border-radius: 10px;
        width: 100%;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .btn-register:hover {
        background: #00796b;
    }

    .login-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.95rem;
        color: #333;
    }

    .login-footer a {
        color: #00897b;
        font-weight: 600;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="register-header">
    <div class="register-logo">Cinema XXI</div>
    <div class="register-title">Buat akun m.tix kamu</div>
</div>

<div class="register-box">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input id="name" type="text" name="name" value="{{ old('name') }}"
               class="form-control @error('name') is-invalid @enderror"
               placeholder="Nama panjang" required autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror

        <input id="email" type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Email" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror

        <input id="password" type="password" name="password"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Kata sandi" required autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror

        <input id="password-confirm" type="password" name="password_confirmation"
               class="form-control" placeholder="Konfirmasi kata sandi" required autocomplete="new-password">

        <button type="submit" class="btn-register">Lanjut</button>
    </form>

    <div class="login-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
</div>
@endsection
