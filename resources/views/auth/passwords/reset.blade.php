@extends('layouts.app')

@section('title', 'Reset Password - SI XXI')

@push('styles')
<!-- Font & Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: #000000; /* FULL BLACK */
        color: #fff;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .reset-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        text-align: center;
        animation: fadeIn 0.8s ease-in-out;
    }

    .reset-logo {
        font-size: 2rem;
        font-weight: 700;
        color: #e50914;
        margin-bottom: 0.5rem;
    }

    .reset-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 30px;
    }

    .reset-box {
        width: 100%;
        max-width: 420px;
        background: #0a0a0a; /* PURE DARK */
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
        background: #000; /* Full black input */
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

    .btn-reset {
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

    .btn-reset:hover {
        background: #f6121d;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(229, 9, 20, 0.4);
    }

    .back-to-login {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #bbb;
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s;
    }

    .back-to-login:hover {
        color: #e50914;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="reset-container">
    <div class="reset-logo">🎬 SI XXI</div>
    <div class="reset-title">Reset Password</div>

    <div class="reset-box">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email" class="block mb-2 text-sm text-gray-300">Email Address</label>
            <input id="email" type="email"
                class="form-control @error('email') border-red-500 @enderror"
                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <label for="password" class="block mb-2 text-sm text-gray-300">Password Baru</label>
            <input id="password" type="password"
                class="form-control @error('password') border-red-500 @enderror"
                name="password" required autocomplete="new-password">
            @error('password')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <label for="password-confirm" class="block mb-2 text-sm text-gray-300">Konfirmasi Password Baru</label>
            <input id="password-confirm" type="password"
                class="form-control @error('password_confirmation') border-red-500 @enderror"
                name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
            <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-reset mt-2">Reset Password</button>
        </form>
    </div>

    <a href="{{ route('login') }}" class="back-to-login">← Kembali ke Login</a>
</div>
@endsection
