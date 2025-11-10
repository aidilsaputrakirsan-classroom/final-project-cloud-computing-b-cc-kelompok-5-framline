@extends('layouts.app')

@section('title', 'Cinema XXI - Feel the Movies Beyond')

@push('styles')
<!-- Tailwind CDN -->
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

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endpush


@section('content')
<body class="bg-dark text-white font-sans">

<section class="min-h-screen bg-gradient-to-b from-black via-dark to-black text-white px-8 md:px-16 py-12">

    <!-- ✅ HEADER -->
    <div class="flex justify-between items-center">
        <img src="/logo.png" alt="Cinema XXI" class="h-10">

        <div class="space-x-4">
            <a href="{{ route('login') }}"
                class="px-4 py-2 border border-netflix rounded-full hover:bg-netflix transition">
                Login
            </a>

            <a href="{{ route('register') }}"
                class="px-4 py-2 bg-netflix rounded-full hover:bg-red-600 transition">
                Register
            </a>
        </div>
    </div>

    <!-- ✅ HERO -->
    <div class="text-center mt-24">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            Feel the <span class="text-netflix">Movies</span> Beyond
        </h1>

        <p class="text-gray-400 text-lg mb-8">
            Discover, explore, and experience films like never before.
        </p>

        <form method="GET" action="{{ route('films.search') }}"
              class="max-w-2xl mx-auto flex items-center bg-slate-800/70 rounded-full px-5 py-3 shadow-lg backdrop-blur-md">

            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search movies or cinemas..."
                   class="flex-grow bg-transparent outline-none text-white placeholder-gray-400">

            <button class="p-3 bg-netflix rounded-full hover:bg-red-600 transition">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>

    <!-- ✅ GENRE SECTION -->
    <div class="mt-24">
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
                        class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition">

                    @if($genre->image)
                        <img src="{{ asset('storage/' . $genre->image) }}"
                             class="w-10 h-10 rounded-full mx-auto mb-2 object-cover">
                    @endif

                    {{ $genre->name }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- ✅ NOW PLAYING -->
    <div class="mt-24">
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
                        <p class="text-sm text-gray-400">{{ $film->genre->name ?? 'Unknown' }} | {{ $film->tahun_rilis }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>
</body>
@endsection
