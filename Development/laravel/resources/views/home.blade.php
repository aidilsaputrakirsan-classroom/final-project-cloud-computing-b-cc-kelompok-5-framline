@extends('layouts.app')
@section('title', 'Cinema XXI - Home')

@push('styles')
<!-- Tailwind -->
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

<!-- Font + Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
    <div class="text-center mt-20">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
            Welcome Back, <span class="text-netflix">{{ Auth::user()->name }}</span>!
        </h1>

        <p class="text-gray-400 text-lg mb-10">
            Explore and enjoy the latest movies from Cinema XXI
        </p>

        <!-- ✅ Search -->
        <form method="GET" action="{{ route('films.search') }}"
              class="max-w-2xl mx-auto flex items-center bg-slate-800/70 rounded-full px-6 py-3 shadow-lg backdrop-blur-md">

            <input type="text" name="search"
                   placeholder="Search movies..."
                   class="flex-grow bg-transparent outline-none text-white placeholder-gray-400">

            <button class="p-3 bg-netflix rounded-full hover:bg-red-600 transition">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>

    <!-- ✅ GENRE -->
    <section x-data="{ showAllGenre: false, selectedYear: '' }" class="mt-24">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h2 class="text-2xl font-semibold">Browse by Genre & Year</h2>

            <div class="flex items-center gap-4">
                <select x-model="selectedYear"
                        class="bg-slate-800 text-white border border-slate-600 px-4 py-2 rounded-lg">
                    <option value="">All Years</option>
                    @foreach(range(date('Y'), date('Y') - 10) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <button @click="showAllGenre = !showAllGenre"
                        class="text-netflix hover:underline">
                    <span x-text="showAllGenre ? 'Show Less ←' : 'See All →'"></span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            @foreach ($genres as $i => $genre)
                <div x-show="showAllGenre || {{ $i }} < 6"
                     x-transition
                     @click="window.location.href='{{ route('films.index', ['genre' => $genre->name]) }}' + (selectedYear ? '&year=' + selectedYear : '')"
                     class="bg-slate-800/70 border border-slate-700 hover:border-netflix hover:bg-netflix/10 transition rounded-xl p-4 text-center cursor-pointer">

                    @if($genre->image)
                        <div class="w-14 h-14 mx-auto rounded-full overflow-hidden mb-3">
                            <img src="{{ asset('storage/'.$genre->image) }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-14 h-14 mx-auto rounded-full bg-netflix flex items-center justify-center text-white text-xl font-bold mb-3">
                            {{ strtoupper(substr($genre->name, 0, 1)) }}
                        </div>
                    @endif

                    <h3 class="font-medium">{{ $genre->name }}</h3>

                    <p x-show="selectedYear"
                       class="text-gray-400 text-sm mt-1"
                       x-text="'Year: ' + selectedYear"></p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ✅ NOW PLAYING -->
    <section x-data="{ showAll: false }" class="mt-24 mb-24">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold">Now Playing</h2>

            <button @click="showAll = !showAll" class="text-netflix hover:underline">
                <span x-text="showAll ? 'Show Less ←' : 'See All →'"></span>
            </button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
            @forelse ($films as $film)
                <div x-show="showAll || {{ $loop->index }} < 5"
                     x-transition
                     @click="window.location.href='{{ route('films.show', $film) }}'"
                     class="bg-slate-800/60 rounded-2xl overflow-hidden hover:scale-105 shadow-lg transition cursor-pointer">

                    <img src="{{ asset('storage/' . $film->poster) }}"
                         class="w-full h-72 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ $film->judul }}</h3>
                        <p class="text-sm text-gray-400">
                            {{ $film->genre->name ?? 'No Genre' }} | {{ $film->tahun_rilis }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500 text-center">Belum ada film.</p>
            @endforelse
        </div>
    </section>

</section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
