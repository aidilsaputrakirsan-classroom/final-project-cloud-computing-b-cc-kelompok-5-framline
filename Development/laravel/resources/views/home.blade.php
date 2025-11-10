@extends('layouts.app')
@section('title', 'Cinema XXI - Home')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: radial-gradient(circle at top, #141414 0%, #000 100%);
        color: #fff;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    h1, h2, h3 {
        color: #fff;
    }

    .hero-section {
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(20, 20, 20, 0.95)), 
                    url('https://image.tmdb.org/t/p/original/6UH52Fmau8RPsMAbQbjwN3wJSCj.jpg') center/cover no-repeat;
        padding: 120px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 3px 20px rgba(0, 0, 0, 0.7);
        animation: fadeInUp 1s ease;
    }

    .hero-subtitle {
        color: #ccc;
        margin-top: 10px;
        font-size: 1.1rem;
        animation: fadeInUp 1.2s ease;
    }

    .search-bar {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        border-radius: 50px;
        padding: 12px 20px;
        width: 100%;
        max-width: 500px;
        transition: all 0.3s ease;
    }

    .search-bar:focus {
        border-color: #e50914;
        box-shadow: 0 0 10px rgba(229, 9, 20, 0.3);
        outline: none;
    }

    .genre-card {
        background: rgba(30, 30, 30, 0.9);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.3s ease;
    }

    .genre-card:hover {
        background: rgba(229, 9, 20, 0.25);
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(229, 9, 20, 0.3);
    }

    .movie-card {
        background: rgba(40, 40, 40, 0.9);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .movie-card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(229, 9, 20, 0.3);
    }

    .movie-card img {
        width: 100%;
        height: auto;
        transition: transform 0.4s ease;
    }

    .movie-card:hover img {
        transform: scale(1.1);
    }

    .section-title {
        color: #fff;
        font-weight: 600;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    select, button {
        background: #1f1f1f;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        border-radius: 8px;
        padding: 8px 14px;
        transition: all 0.3s ease;
    }

    button:hover, select:focus {
        border-color: #e50914;
        color: #e50914;
    }

    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<!-- 🎬 Hero Section -->
<section class="hero-section">
    <h1 class="hero-title">Welcome back, {{ Auth::user()->name }}!</h1>
    <p class="hero-subtitle">Enjoy the latest movies and genres from Cinema XXI</p>

    <div class="mt-6 flex justify-center">
        <div class="relative w-80 md:w-1/2">
            <input type="text" placeholder="Search movies or cinemas"
                   class="search-bar">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 absolute right-6 top-3.5 text-gray-300" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </div>
    </div>
</section>

<!-- 🍿 Browse by Genre & Year -->
<section x-data="{ showAllGenre: false, selectedYear: '' }" class="mt-16 px-8 md:px-16">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <h2 class="section-title">Browse by Genre & Year</h2>

        <div class="flex items-center gap-4">
            <select x-model="selectedYear">
                <option value="">All Years</option>
                @foreach (range(date('Y'), date('Y') - 10) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

            <button @click="showAllGenre = !showAllGenre">
                <span x-text="showAllGenre ? 'Show Less ←' : 'See All →'"></span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        @foreach (['Action', 'Drama', 'Comedy', 'Horror', 'Romance', 'Adventure', 'Sci-Fi', 'Animation', 'Fantasy', 'Mystery'] as $index => $genre)
            <div x-show="showAllGenre || {{ $index }} < 6"
                 x-transition
                 class="genre-card cursor-pointer text-center p-5"
                 @click="window.location.href='{{ url('/films?genre=' . strtolower($genre)) }}' + (selectedYear ? '&year=' + selectedYear : '')">
                <div class="text-2xl font-bold text-red-500">{{ strtoupper(substr($genre, 0, 1)) }}</div>
                <h3 class="mt-2 text-gray-200 font-medium">{{ $genre }}</h3>
                <p x-show="selectedYear" class="text-gray-400 text-xs mt-1" x-text="'Year: ' + selectedYear"></p>
            </div>
        @endforeach
    </div>
</section>

<!-- 🎥 Now Playing -->
<section x-data="{ showAll: false }" class="mt-16 px-8 md:px-16 mb-20">
    <div class="flex items-center justify-between">
        <h2 class="section-title">Now Playing</h2>
        <button @click="showAll = !showAll">
            <span x-text="showAll ? 'Show Less ←' : 'See All →'"></span>
        </button>
    </div>

    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach (range(1, 12) as $i)
            <div x-show="showAll || {{ $i }} <= 5"
                 x-transition
                 class="movie-card">
                <img src="https://dummyimage.com/200x280/{{ ['ccc','aaa','999','777','555','444','333','222','111','000','888','666'][$i-1] }}/fff&text=Movie+{{ $i }}"
                     alt="Movie {{ $i }}">
            </div>
        @endforeach
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
