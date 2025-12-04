@extends('layouts.app')

@section('title', 'My m.tix')

@push('styles')
<style>
    body {
        font-family: 'Inter', sans-serif;
        padding-top: 40px;
        min-height: 100vh;
    }

    .netflix-card {
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 0 25px rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        transition: 0.25s ease;
    }

    .netflix-card:hover {
        box-shadow: 0 0 30px rgba(229, 9, 20, 0.35);
    }

    .menu-item {
        padding: 14px 12px;
        border-radius: 10px;
        transition: 0.25s ease;
    }

    .menu-item:hover {
        cursor: pointer;
    }

    .menu-icon {
        font-size: 1.3rem;
    }

    .header-title {
        font-size: 2.4rem;
        font-weight: 700;
        letter-spacing: .5px;
        text-shadow: 0 0 12px rgba(255,255,255,0.15);
    }

    .breadcrumb-netflix {
        font-size: 0.95rem;
    }

    .initial-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .edit-icon {
        transition: 0.25s;
    }
</style>
@endpush

@section('content')
<div class="px-6 py-10 flex flex-col items-center bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

    <div class="w-full max-w-2xl">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors">
                <i class="bi bi-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Breadcrumb -->
        <p class="breadcrumb-netflix mb-3 text-center md:text-left text-gray-500 dark:text-gray-400">
            Beranda / <span class="text-gray-900 dark:text-gray-100">My m.tix</span>
        </p>

        <!-- Judul -->
        <h1 class="header-title mb-6 text-center md:text-left text-gray-900 dark:text-gray-100">My m.tix</h1>

        <!-- Profil -->
        <div class="netflix-card flex items-center justify-between mb-7 bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-4">
                <div class="initial-avatar bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-lg font-semibold capitalize text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ Auth::user()->phone ?? '628xxxxxxxx' }}</p>
                </div>
            </div>
            <button class="edit-icon text-gray-400 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-500">
                <i class="bi bi-pencil"></i>
            </button>
        </div>

        <!-- Bagian Pengaturan -->
        <div class="mb-8">
            <h4 class="text-gray-500 dark:text-gray-400 font-semibold text-xs uppercase tracking-wider mb-3">
                Pengaturan
            </h4>

            <ul class="space-y-2">

                <li onclick="window.location.href='{{ route('profile.change-password') }}'"  
                    class="menu-item flex items-center justify-between bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-shield-lock menu-icon text-gray-500 dark:text-gray-400"></i>
                        <span class="menu-text">Ganti Password</span>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400 dark:text-gray-500"></i>
                </li>
            </ul>
        </div>        <!-- Bagian Aktivitas -->
        <div>
            <h4 class="text-gray-500 dark:text-gray-400 font-semibold text-xs uppercase tracking-wider mb-3">
                Aktivitas Saya
            </h4>

            <ul class="space-y-2">

                <li onclick="window.location.href='{{ route('profile.favorites') }}'"  
                    class="menu-item flex items-center justify-between bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-heart-fill menu-icon text-gray-500 dark:text-gray-400"></i>
                        <span class="menu-text">Daftar Film Favorit</span>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400 dark:text-gray-500"></i>
                </li>

                <li onclick="window.location.href='{{ route('profile.history') }}'"  
                    class="menu-item flex items-center justify-between bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-clock-history menu-icon text-gray-500 dark:text-gray-400"></i>
                        <span class="menu-text">Riwayat Tontonan</span>
                    </div>
                    <i class="bi bi-chevron-right text-gray-400 dark:text-gray-500"></i>
                </li>

            </ul>
        </div>    </div>
</div>
@endsection
