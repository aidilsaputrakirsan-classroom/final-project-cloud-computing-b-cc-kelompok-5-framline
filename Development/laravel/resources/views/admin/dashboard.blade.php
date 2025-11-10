@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 px-6 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">🎬 Admin Dashboard</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-4xl font-bold text-teal-600">{{ $stats['total_films'] }}</h2>
            <p class="text-gray-600 mt-2">Total Film</p>
        </div>
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-4xl font-bold text-teal-600">{{ $stats['total_genres'] }}</h2>
            <p class="text-gray-600 mt-2">Total Genre</p>
        </div>
        <div class="bg-white shadow rounded-xl p-6 text-center">
            <h2 class="text-4xl font-bold text-teal-600">{{ $stats['total_users'] }}</h2>
            <p class="text-gray-600 mt-2">Total Pengguna</p>
        </div>
    </div>

    <!-- Menu CRUD -->
    <div class="grid md:grid-cols-3 gap-6">
        <a href="{{ route('admin.films.index') }}" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Kelola Film</h3>
                    <p class="text-gray-500 text-sm mt-2">Tambah, edit, atau hapus data film</p>
                </div>
                <i class="bi bi-film text-3xl text-teal-600"></i>
            </div>
        </a>

        <a href="{{ route('admin.genres.index') }}" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Kelola Genre</h3>
                    <p class="text-gray-500 text-sm mt-2">Atur daftar genre film</p>
                </div>
                <i class="bi bi-tags text-3xl text-teal-600"></i>
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Kelola Pengguna</h3>
                    <p class="text-gray-500 text-sm mt-2">Atur hak akses user dan admin</p>
                </div>
                <i class="bi bi-people text-3xl text-teal-600"></i>
            </div>
        </a>
    </div>
</div>
@endsection
