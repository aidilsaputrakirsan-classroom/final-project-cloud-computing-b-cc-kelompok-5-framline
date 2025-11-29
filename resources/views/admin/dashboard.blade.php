@extends('layouts.app')
@section('title', 'Admin Dashboard')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

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
