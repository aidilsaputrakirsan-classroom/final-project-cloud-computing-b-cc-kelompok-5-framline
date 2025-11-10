@extends('layouts.app')

@section('title', $film->judul)

@section('content')
<div class="container mx-auto px-4 py-10 text-gray-100">

    <div class="max-w-5xl mx-auto">

        <!-- Header Card Netflix Style -->
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl overflow-hidden shadow-2xl mb-10">

            <div class="md:flex">

                <!-- Poster -->
                <div class="md:w-1/3 relative overflow-hidden">
                    @if($film->poster)
                        <img 
                            src="{{ asset('storage/' . $film->poster) }}" 
                            class="w-full h-[450px] object-cover brightness-90 hover:brightness-100 transition-all duration-300 md:rounded-l-2xl"
                        >
                    @else
                        <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                            <i class="bi bi-film text-6xl text-gray-600"></i>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="md:w-2/3 p-8">

                    <h1 class="text-4xl font-extrabold tracking-wide mb-6">{{ $film->judul }}</h1>

                    <!-- Metadata Grid -->
                    <div class="grid grid-cols-2 gap-6 mb-8 text-sm">

                        <div>
                            <p class="text-gray-400">Tahun Rilis</p>
                            <p class="text-lg font-semibold">{{ $film->tahun_rilis }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Durasi</p>
                            <p class="text-lg font-semibold">{{ $film->durasi ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Sutradara</p>
                            <p class="text-lg font-semibold">{{ $film->sutradara }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Genre</p>
                            <p class="text-lg font-semibold">{{ $film->genre->name }}</p>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    @auth
                        <div class="flex gap-4 mt-4">

                            <!-- Favorite -->
                            <form action="{{ route('films.favorite', $film) }}" method="POST">
                                @csrf
                                <button 
                                    type="submit" 
                                    class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg text-white font-semibold text-sm flex items-center gap-2 transition"
                                >
                                    <i class="bi bi-heart{{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? '-fill' : '' }}"></i>
                                    {{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                                </button>
                            </form>
                        </div>
                    @endauth

                </div>
            </div>
        </div>

        <!-- SINOPSIS (Netflix-style section) -->
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl p-8 shadow-lg mb-10">
            <h2 class="text-2xl font-bold mb-4">Sinopsis</h2>
            <p class="text-gray-300 leading-relaxed text-lg">
                {{ $film->sinopsis }}
            </p>
        </div>

        <!-- PEMERAN -->
        @if($film->aktor)
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl p-8 shadow-lg mb-10">
            <h2 class="text-2xl font-bold mb-4">Pemeran</h2>
            <p class="text-gray-300 text-lg">{{ $film->aktor }}</p>
        </div>
        @endif

        <!-- Back Button -->
        <div class="text-center mt-10">
            <a 
                href="{{ url()->previous() }}" 
                class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg inline-flex items-center gap-2 font-semibold transition"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection
