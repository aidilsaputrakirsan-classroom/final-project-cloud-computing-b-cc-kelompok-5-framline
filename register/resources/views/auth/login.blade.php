@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<style>
    body {
        background: linear-gradient(180deg, #ffffff 0%, #e8f9fa 100%);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
    }

    .login-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        text-align: center;
    }

    .login-logo {
        font-family: "Playfair Display", serif;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .login-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 40px;
    }

    .login-box {
        width: 200%;
        max-width: 620px;
        background: #f9ffff;
        border-radius: 12px;
        padding: 35px 40px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        text-align: left;
    }

    .form-control {
        width: 100%;
        height: 50px;
        border: 1px solid #bcd9db;
        border-radius: 8px;
        background: #f2fcfc;
        font-size: 1rem;
        padding: 20px 15px;
        margin-bottom: 20px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #00897b;
    }

    .btn-login {
        background: #00897b;
        color: white;
        border: none;
        height: 50px;
        border-radius: 10px;
        width: 100%;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .btn-login:hover {
        background: #00796b;
    }

    .forgot-pin {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: #00897b;
        font-weight: 600;
        text-decoration: none;
    }

    .forgot-pin:hover {
        text-decoration: underline;
    }

    .login-footer {
        margin-top: 25px;
        color: #333;
        text-align: center;
    }

    .login-footer a {
        color: #00897b;
        text-decoration: none;
        font-weight: 600;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-logo">🎬 Cinema XXI</div>
    <div class="login-title">Hai, senang ketemu lagi!</div>

    <div class="login-box">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="form-label text-sm text-gray-700">Nomor Telepon / Email</label>
            <input id="email" type="text"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror

            <label for="password" class="form-label text-sm text-gray-700">Masukkan PIN / Password</label>
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required>
            @error('password')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-login">Login</button>

            <a href="{{ route('password.request') }}" class="forgot-pin">Lupa PIN?</a>
        </form>
    </div>

    <div class="login-footer">
        Gak punya akun? <a href="{{ route('register') }}">Yuk, buat akun</a>
    </div>
</div>
@endsection
