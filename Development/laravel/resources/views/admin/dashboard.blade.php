@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen px-6 py-10 text-teal-900 transition-colors duration-300">
    {{-- Judul Halaman --}}
    <h1 class="text-3xl font-bold text-teal-800 mb-8">🎬 Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        {{-- Card Statistik 1: Total Film --}}
        <div class="bg-white shadow rounded-xl p-6 text-center text-teal-800 dark:shadow-xl transition-colors">
            <h2 class="text-4xl font-bold text-black">{{ $stats['total_films'] }}</h2>
            {{-- Teks di bawah angka statistik --}}
            <p class="text-gray-600 mt-2 dark:text-gray-400">Total Film</p>
        </div>
        {{-- Card Statistik 2: Total Genre --}}
        <div class="bg-white shadow rounded-xl p-6 text-center text-teal-800 dark:shadow-xl transition-colors">
            <h2 class="text-4xl font-bold text-black">{{ $stats['total_genres'] }}</h2>
            {{-- Teks di bawah angka statistik --}}
            <p class="text-gray-600 mt-2 dark:text-gray-400">Total Genre</p>
        </div>
        {{-- Card Statistik 3: Total Pengguna --}}
        <div class="bg-white shadow rounded-xl p-6 text-center text-teal-800 dark:shadow-xl transition-colors">
            <h2 class="text-4xl font-bold text-black">{{ $stats['total_users'] }}</h2>
            {{-- Teks di bawah angka statistik --}}
            <p class="text-gray-600 mt-2 dark:text-gray-400">Total Pengguna</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        {{-- Card Menu 1: Kelola Film --}}
        <a href="{{ route('admin.films.index') }}" 
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-teal-800 dark:shadow-xl dark:hover:shadow-2xl dark:border dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    {{-- Judul Menu --}}
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Kelola Film</h3>
                    {{-- Deskripsi Menu --}}
                    <p class="text-gray-500 text-sm mt-2 dark:text-gray-400">Tambah, edit, atau hapus data film</p>
                </div>
                {{-- Ikon --}}
                <i class="bi bi-film text-3xl text-black"></i>
            </div>
        </a>

        {{-- Card Menu 2: Kelola Genre --}}
        <a href="{{ route('admin.genres.index') }}" 
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-teal-800 dark:shadow-xl dark:hover:shadow-2xl dark:border dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    {{-- Judul Menu --}}
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Kelola Genre</h3>
                    {{-- Deskripsi Menu --}}
                    <p class="text-gray-500 text-sm mt-2 dark:text-gray-400">Atur daftar genre film</p>
                </div>
                {{-- Ikon --}}
                <i class="bi bi-tags text-3xl text-black"></i>
            </div>
        </a>

        {{-- Card Menu 3: Kelola Pengguna --}}
        <a href="{{ route('admin.users.index') }}" 
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-teal-800 dark:shadow-xl dark:hover:shadow-2xl dark:border dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    {{-- Judul Menu --}}
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Kelola Pengguna</h3>
                    {{-- Deskripsi Menu --}}
                    <p class="text-gray-500 text-sm mt-2 dark:text-gray-400">Atur hak akses user dan admin</p>
                </div>
                {{-- Ikon --}}
                <i class="bi bi-people text-3xl text-black"></i>
            </div>
        </a>
    </div>
</div>
@endsection