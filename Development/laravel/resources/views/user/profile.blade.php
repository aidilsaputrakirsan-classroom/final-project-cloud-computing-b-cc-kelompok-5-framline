@extends('layouts.app')

@section('title', 'My m.tix')

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

    .menu-item {
        padding: 14px 12px;
        border-radius: 10px;
        transition: 0.25s ease;
    }

    .menu-item:hover {
        background: rgba(255,255,255,0.08);
        cursor: pointer;
    }

    .menu-icon {
        font-size: 1.3rem;
        color: #bbb;
    }

    .menu-text {
        font-weight: 500;
        color: #eee;
    }

    .header-title {
        font-size: 2.4rem;
        font-weight: 700;
        letter-spacing: .5px;
        color: #fff;
        text-shadow: 0 0 12px rgba(255,255,255,0.15);
    }

    .breadcrumb-netflix {
        color: #aaa;
        font-size: 0.95rem;
    }

    .breadcrumb-netflix span {
        color: #fff;
        font-weight: 600;
    }

    .initial-avatar {
        width: 56px;
        height: 56px;
        background: #222;
        border: 1px solid #333;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .edit-icon {
        color: #888;
        transition: 0.25s;
    }

    .edit-icon:hover {
        color: #e50914;
    }
</style>
@endpush

@section('content')
<div class="px-6 py-10 flex flex-col items-center">

    <div class="w-full max-w-2xl">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors">
                <i class="bi bi-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Breadcrumb -->
        <p class="breadcrumb-netflix mb-3 text-center md:text-left">
            Beranda / <span>My m.tix</span>
        </p>

        <!-- Judul -->
        <h1 class="header-title mb-6 text-center md:text-left">My m.tix</h1>

        <!-- Profil -->
        <div class="netflix-card flex items-center justify-between mb-7">
            <div class="flex items-center gap-4">
                <div class="initial-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-lg font-semibold capitalize">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-400 text-sm">{{ Auth::user()->phone ?? '628xxxxxxxx' }}</p>
                </div>
            </div>
            <button class="edit-icon">
                <i class="bi bi-pencil"></i>
            </button>
        </div>

        <!-- Bagian Pengaturan -->
        <div class="mb-8">
            <h4 class="text-gray-400 font-semibold text-xs uppercase tracking-wider mb-3">
                Pengaturan
            </h4>

            <ul class="space-y-2">

                <li onclick="window.location.href='{{ route('profile.change-password') }}'"
                    class="menu-item flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-shield-lock menu-icon"></i>
                        <span class="menu-text">Ganti Password</span>
                    </div>
                    <i class="bi bi-chevron-right text-gray-500"></i>
                </li>
            </ul>
        </div>

        <!-- Bagian Aktivitas -->
        <div>
            <h4 class="text-gray-400 font-semibold text-xs uppercase tracking-wider mb-3">
                Aktivitas Saya
            </h4>

            <ul class="space-y-2">

                <li onclick="window.location.href='{{ route('profile.favorites') }}'"
                    class="menu-item flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-heart-fill menu-icon"></i>
                        <span class="menu-text">Daftar Film Favorit</span>
                    </div>
                    <i class="bi bi-chevron-right text-gray-500"></i>
                </li>

                <li onclick="window.location.href='{{ route('profile.history') }}'"
                    class="menu-item flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-clock-history menu-icon"></i>
                        <span class="menu-text">Riwayat Tontonan</span>
                    </div>
                    <i class="bi bi-chevron-right text-gray-500"></i>
                </li>

            </ul>
        </div>

    </div>
</div>
@endsection
