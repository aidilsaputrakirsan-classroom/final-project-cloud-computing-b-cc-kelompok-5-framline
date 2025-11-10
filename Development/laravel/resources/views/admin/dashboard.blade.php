@extends('layouts.app')
@section('title', 'Admin Dashboard')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: radial-gradient(circle at top, #141414 0%, #000 100%);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-hero {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(20, 20, 20, 0.95)),
                    url('https://image.tmdb.org/t/p/original/t/p/original/6UH52Fmau8RPsMAbQbjwN3wJSCj.jpg') center/cover no-repeat;
        padding: 100px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dashboard-hero h1 {
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
        animation: fadeInUp 1s ease;
    }

    .dashboard-hero p {
        color: #ccc;
        margin-top: 10px;
        font-size: 1.1rem;
        animation: fadeInUp 1.2s ease;
    }

    .stat-card {
        background: rgba(30, 30, 30, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        text-align: center;
        padding: 30px 20px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        background: rgba(229, 9, 20, 0.25);
        box-shadow: 0 8px 20px rgba(229, 9, 20, 0.3);
    }

    .stat-card h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #e50914;
    }

    .stat-card p {
        color: #ccc;
        margin-top: 10px;
    }

    .menu-card {
        background: rgba(40, 40, 40, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(229, 9, 20, 0.3);
        background: rgba(229, 9, 20, 0.2);
    }

    .menu-card h3 {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .menu-card p {
        color: #aaa;
        font-size: 0.9rem;
        margin-top: 6px;
    }

    .menu-card i {
        font-size: 2.5rem;
        color: #e50914;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<!-- 🎬 Hero Section -->
<section class="dashboard-hero">
    <h1>Welcome, Admin!</h1>
    <p>Manage films, genres, and users — all in one cinematic view 🎥</p>
</section>

<!-- 📊 Statistik -->
<div class="px-8 md:px-16 py-12">
    <h2 class="text-2xl font-semibold mb-8 border-l-4 border-red-600 pl-3">Dashboard Statistics</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="stat-card">
            <h2>{{ $stats['total_films'] }}</h2>
            <p>Total Film</p>
        </div>
        <div class="stat-card">
            <h2>{{ $stats['total_genres'] }}</h2>
            <p>Total Genre</p>
        </div>
        <div class="stat-card">
            <h2>{{ $stats['total_users'] }}</h2>
            <p>Total Pengguna</p>
        </div>
    </div>
</div>

<!-- ⚙️ Menu Admin -->
<div class="px-8 md:px-16 pb-20">
    <h2 class="text-2xl font-semibold mb-8 border-l-4 border-red-600 pl-3">Manage Content</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <a href="{{ route('admin.films.index') }}" class="menu-card flex items-center justify-between">
            <div>
                <h3>Kelola Film</h3>
                <p>Tambah, edit, atau hapus data film</p>
            </div>
            <i class="bi bi-film"></i>
        </a>

        <a href="{{ route('admin.genres.index') }}" class="menu-card flex items-center justify-between">
            <div>
                <h3>Kelola Genre</h3>
                <p>Atur daftar genre film</p>
            </div>
            <i class="bi bi-tags"></i>
        </a>

        <a href="{{ route('admin.users.index') }}" class="menu-card flex items-center justify-between">
            <div>
                <h3>Kelola Pengguna</h3>
                <p>Atur hak akses user dan admin</p>
            </div>
            <i class="bi bi-people"></i>
        </a>
    </div>
</div>
@endsection
