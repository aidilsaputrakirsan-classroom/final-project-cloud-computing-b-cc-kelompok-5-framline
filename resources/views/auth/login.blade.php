@extends('layouts.app')

@section('title', 'Login - SI XXI')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .login-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }

    .login-logo {
        font-size: 2rem;
        font-weight: 700;
        color: #e50914;
        margin-bottom: 0.5rem;
    }

    .login-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .login-box {
        width: 100%;
        max-width: 420px;
        border-radius: 14px;
        padding: 40px 35px;
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 0 25px rgba(0,0,0,0.9);
        text-align: left;
    }

    .form-control {
        width: 100%;
        height: 50px;
        border: 1px solid #222;
        border-radius: 8px;
        font-size: 1rem;
        padding: 14px 15px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.3);
    }

    .btn-login {
        background: #e50914;
        color: white;
        border: none;
        height: 50px;
        border-radius: 8px;
        width: 100%;
        font-weight: 600;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        cursor: pointer;
    }

    .btn-login:hover {
        background: #f6121d;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(229, 9, 20, 0.4);
    }

    .forgot-pin {
        display: block;
        text-align: center;
        margin-top: 10px;
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s;
    }

    .forgot-pin:hover {
        color: #e50914;
    }

    .login-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 0.95rem;
    }

    .login-footer a {
        color: #e50914;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .login-footer a:hover {
        color: #ff4b4b;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="login-container bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="login-logo">🎬 SI XXI</div>
    <div class="login-title text-gray-900 dark:text-gray-100">Welcome Back</div>

    <div class="login-box bg-white dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-300">Email</label>
            <input id="email" type="text"
                class="form-control @error('email') is-invalid @enderror bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600"
                name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <label for="password" class="block mb-2 text-sm text-gray-600 dark:text-gray-300">Masukkan Password</label>
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600"
                name="password" required>
            @error('password')
            <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-login mt-2">Login</button>
        </form>
    </div>

    <div class="login-footer text-gray-600 dark:text-gray-300">
        Gak punya akun? <a href="{{ route('register') }}">Yuk, buat akun</a>
    </div>
</div>
@endsection
