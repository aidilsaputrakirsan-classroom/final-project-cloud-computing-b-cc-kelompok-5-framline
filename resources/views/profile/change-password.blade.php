@extends('layouts.app')

@section('title', 'Ubah Password')

@push('styles')
<style>
    body {
        background: #000;
        font-family: 'Inter', sans-serif;
        color: #fff;
        padding-top: 40px;
        min-height: 100vh;
    }

    .netflix-card {
        background: rgba(20, 20, 20, 0.9);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 0 25px rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        transition: 0.25s ease;
    }

    .netflix-card:hover {
        border-color: #e50914;
        box-shadow: 0 0 30px rgba(229, 9, 20, 0.35);
    }

    .form-input {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        border-radius: 8px;
        padding: 12px;
        width: 100%;
    }

    .form-input:focus {
        border-color: #e50914;
        outline: none;
    }

    .btn-netflix {
        background-color: #e50914;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.25s;
    }

    .btn-netflix:hover {
        background-color: #b20710;
    }

    .breadcrumb-netflix {
        color: #aaa;
        font-size: 0.95rem;
    }

    .breadcrumb-netflix a {
        color: #fff;
        text-decoration: none;
    }

    .breadcrumb-netflix a:hover {
        text-decoration: underline;
    }

    .header-title {
        font-size: 2.4rem;
        font-weight: 700;
        letter-spacing: .5px;
        color: #fff;
        text-shadow: 0 0 12px rgba(255,255,255,0.15);
    }
</style>
@endpush

@section('content')
<div class="px-6 py-10 flex flex-col items-center">

    <div class="w-full max-w-md">

        <!-- Breadcrumb -->
        <p class="breadcrumb-netflix mb-3">
            <a href="{{ route('profile.show') }}">Beranda</a> / <a href="{{ route('profile.show') }}">My m.tix</a> / <span>Ubah Password</span>
        </p>

        <!-- Judul -->
        <h1 class="header-title mb-6 text-center">Ubah Password</h1>

        <!-- Form -->
        <div class="netflix-card">
            <form method="POST" action="{{ route('profile.update-password') }}">
                @csrf

                <!-- Current Password -->
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium mb-2">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="form-input" required>
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-netflix w-full">Ubah Password</button>
            </form>

            <!-- Success Message -->
            @if(session('success'))
                <p class="text-green-500 text-sm mt-4">{{ session('success') }}</p>
            @endif
        </div>

    </div>
</div>
@endsection
