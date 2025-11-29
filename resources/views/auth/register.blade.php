@extends('layouts.app')

@section('title', 'Register - SI XXI')

@push('styles')
<!-- Font & Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: #000000;
        color: #fff;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .register-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }

    .register-logo {
        font-size: 2rem;
        font-weight: 700;
        color: #e50914;
        margin-bottom: 0.5rem;
    }

    .register-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 30px;
    }

    .register-box {
        width: 100%;
        max-width: 420px;
        background: #0a0a0a;
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
        background: #000;
        color: #fff;
        font-size: 1rem;
        padding: 14px 15px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 0 0 0 3px rgba(229, 9, 20, 0.3);
    }

    .btn-register {
        background: #e50914;
        color: white;
        border: none;
        height: 50px;
        border-radius: 8px;
        width: 100%;
        font-weight: 600;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-register:hover {
        background: #f6121d;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(229, 9, 20, 0.4);
    }

    .register-footer {
        margin-top: 25px;
        color: #ccc;
        text-align: center;
        font-size: 0.95rem;
    }

    .register-footer a {
        color: #e50914;
        font-weight: 600;
        text-decoration: none;
    }

    .register-footer a:hover {
        color: #ff4b4b;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="register-container">

    <div class="register-logo">🎬 SI XXI</div>
    <div class="register-title">Buat Akun Baru</div>

    <div class="register-box">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name" class="block mb-2 text-sm text-gray-300">Nama Lengkap</label>
            <input id="name" type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <label for="email" class="block mb-2 text-sm text-gray-300">Email</label>
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <label for="password" class="block mb-2 text-sm text-gray-300">Password</label>
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password" required>
            @error('password')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <label for="password-confirm" class="block mb-2 text-sm text-gray-300">Konfirmasi Password</label>
            <input id="password-confirm" type="password"
                class="form-control"
                name="password_confirmation" required>

            <button type="submit" class="btn-register mt-2">Daftar</button>
        </form>
    </div>

    <div class="register-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>

</div>
@endsection
