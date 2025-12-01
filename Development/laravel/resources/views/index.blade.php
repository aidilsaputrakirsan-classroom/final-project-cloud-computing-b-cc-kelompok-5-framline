@extends('layouts.app')

@section('title', 'Cinema XXI - Feel the Movies Beyond')

@push('styles')
<!-- Tailwind & Fonts -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          netflix: '#e50914',
          dark: '#141414',
        },
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        },
      },
    },
  };
</script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
  /* body {
    background: radial-gradient(circle at top, #141414 0%, #000 100%);
    color: #fff;
    font-family: 'Poppins', sans-serif;
  } */

  .cinema-hero {
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.85), rgba(20, 20, 20, 0.95)),
                url('https://i.pinimg.com/736x/f4/34/7b/f4347b3e917a6bdbac9e58abe6c36a66.jpg') center/cover no-repeat;
    padding: 120px 20px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  /* Modern search bar */
  .search-bar {
    background: rgba(30, 30, 30, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    border-radius: 9999px;
    display: flex;
    align-items: center;
    padding: 8px 16px;
    max-width: 600px;
    margin: 0 auto;
    transition: box-shadow 0.3s ease;
  }

  .search-bar:focus-within {
    box-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
  }

  .search-bar input {
    flex: 1;
    background: transparent;
    border: none;
    color: white;
    padding: 10px;
    font-size: 1rem;
    outline: none;
  }

  .search-bar input::placeholder {
    color: #aaa;
  }

  .search-bar button {
    background: #e50914;
    border-radius: 9999px;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: background 0.3s ease;
  }

  .search-bar button:hover {
    background: #ff141f;
  }
</style>
@endpush


@section('content')

<!-- 🎬 HERO SECTION -->
<section class="cinema-hero">
  <h1 class="text-5xl md:text-6xl font-bold mb-4 text-white">
    Feel the <span class="text-netflix">Movies</span> Beyond
  </h1>

  <p class="text-gray-300 text-lg mb-10">
    Discover, explore, and experience films like never before.
  </p>

  <!-- 🔍 Search -->
  <form method="GET" action="{{ route('films.search') }}" class="search-bar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies or cinemas...">
    <button type="submit">
      <i class="fa fa-search"></i>
    </button>
  </form>
</section>

<!-- 🎞️ GENRE SECTION -->
<section class="px-8 md:px-16 py-16 bg-white dark:bg-black">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Browse by Genre & Year</h2>

    <div class="flex items-center gap-2">
      <select id="year-filter"
        class="bg-slate-800 border border-slate-700 rounded px-3 py-2 text-white">
        <option value="">All Years</option>
        @foreach (range(date('Y'), date('Y') - 10) as $year)
          <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
      </select>

      <a href="#" class="text-netflix hover:underline">See All →</a>
    </div>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 text-center">
    @foreach ($genres as $genre)
      <button onclick="window.location.href='{{ route('films.index', ['genre' => $genre->name]) }}'"
              class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition text-grey-200 dark:text-white">

        @if($genre->image)
          <img src="{{ asset('storage/' . $genre->image) }}"
               class="w-10 h-10 rounded-full mx-auto mb-2 object-cover">
        @endif

        {{ $genre->name }}
      </button>
    @endforeach
  </div>
</section>

<!-- 🎥 NOW PLAYING -->
<section class="px-8 md:px-16 pb-20 bg-white dark:bg-black">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Now Playing</h2>
    <a href="{{ route('films.index') }}" class="text-netflix hover:underline">See All →</a>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
    @foreach ($films as $film)
      <div onclick="window.location.href='{{ route('films.show', $film) }}'"
           class="bg-slate-800/60 rounded-2xl overflow-hidden hover:scale-105 transition-transform shadow-lg cursor-pointer">

        <img src="{{ asset('storage/' . $film->poster) }}"
             class="w-full h-56 object-cover">

        <div class="p-4">
         <h3 class="font-semibold text-lg">{{ $film->judul }}</h3>
          </div>
      </div>
    @endforeach
  </div>
</section>

@endsection
