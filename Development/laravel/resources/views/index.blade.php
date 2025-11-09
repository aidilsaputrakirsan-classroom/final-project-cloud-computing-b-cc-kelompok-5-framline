@extends('layouts.app')

@section('title', 'Cinema XXI - Feel the movies beyond')

@section('content')

  <!-- Hero Section -->
  <section class="text-center mt-10">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Feel the movies beyond</h1>
    <div class="mt-6 flex justify-center">
      <div class="relative w-80 md:w-1/2">
        <input type="text" placeholder="Search movies or cinemas"
               class="w-full px-6 py-3 rounded-full shadow text-gray-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 absolute right-5 top-3.5 text-gray-400" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
      </div>
    </div>
  </section>

    <!-- 🎬 Browse by Genre & Year -->
    <section x-data="{ showAllGenre: false, selectedYear: '' }" class="mt-16 px-8 md:px-16">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h2 class="text-2xl font-semibold text-gray-800">Browse by Genre & Year</h2>

            <div class="flex items-center gap-4">
                <!-- Dropdown Tahun -->
                <div class="relative">
                    <select x-model="selectedYear"
                            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">All Years</option>
                        @foreach (range(date('Y'), date('Y') - 10) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Lihat Semua -->
                <button @click="showAllGenre = !showAllGenre"
                        class="text-teal-700 font-medium hover:underline focus:outline-none">
                    <span x-text="showAllGenre ? 'Show Less ←' : 'See All →'"></span>
                </button>
            </div>
        </div>

        <!-- Grid Genre -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            @foreach (['Action', 'Drama', 'Comedy', 'Horror', 'Romance', 'Adventure', 'Sci-Fi', 'Animation', 'Fantasy', 'Mystery'] as $index => $genre)
                <div x-show="showAllGenre || {{ $index }} < 6"
                     x-transition
                     class="bg-white rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1 cursor-pointer"
                     @click="window.location.href='{{ url('/films?genre=' . strtolower($genre)) }}' + (selectedYear ? '&year=' + selectedYear : '')">
                    <div class="p-4 text-center">
                        <div class="w-12 h-12 mx-auto flex items-center justify-center rounded-full bg-gradient-to-br from-teal-600 to-teal-400 text-white font-bold text-lg">
                            {{ strtoupper(substr($genre, 0, 1)) }}
                        </div>
                        <h3 class="mt-3 text-gray-800 font-medium text-sm md:text-base">{{ $genre }}</h3>
                        <!-- Tahun muncul kalau dipilih -->
                        <p x-show="selectedYear" class="text-gray-500 text-xs mt-1" x-text="'Year: ' + selectedYear"></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

  <!-- 🎥 Now Playing Section -->
  <section x-data="{ showAll: false }" class="mt-14 px-8 md:px-16">
    <div class="flex items-center justify-between">
      <h2 class="text-2xl font-semibold text-gray-800">Now Playing</h2>
      <button @click="showAll = !showAll" class="text-teal-700 font-medium hover:underline focus:outline-none">
        <span x-text="showAll ? 'Show Less ←' : 'See All →'"></span>
      </button>
    </div>

    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
      @forelse ($films as $film)
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition transform hover:-translate-y-1 hover:scale-105 duration-300 p-2">
        <img src="{{ asset('storage/' . $film->poster) }}"
             alt="{{ $film->judul }}"
             class="rounded-lg w-full h-72 object-cover">
        <p class="mt-2 text-center font-semibold text-gray-800">{{ $film->judul }}</p>
      </div>
    @empty
      <p class="col-span-full text-center text-gray-500">Belum ada film yang ditambahkan.</p>
    @endforelse
    </div>
  </section>

  {{-- Load Alpine.js --}}
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
