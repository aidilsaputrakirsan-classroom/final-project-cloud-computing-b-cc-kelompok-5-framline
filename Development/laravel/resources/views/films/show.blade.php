@extends('layouts.app')

@section('title', $film->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Film Header -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="md:flex">
                <!-- Poster -->
                <div class="md:w-1/3">
                    @if($film->poster)
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <i class="bi bi-film text-6xl text-gray-400"></i>
                        </div>
                    @endif
                </div>

                <!-- Film Info -->
                <div class="md:w-2/3 p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $film->judul }}</h1>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-600">Tahun Rilis</p>
                            <p class="font-semibold">{{ $film->tahun_rilis }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Durasi</p>
                            <p class="font-semibold">{{ $film->durasi ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Sutradara</p>
                            <p class="font-semibold">{{ $film->sutradara }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Genre</p>
                            <p class="font-semibold">{{ $film->genre->name }}</p>
                        </div>
                    </div>

                    @auth
                        <div class="flex gap-4">
                            <form action="{{ route('films.favorite', $film) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg flex items-center gap-2">
                                    <i class="bi bi-heart{{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? '-fill' : '' }}"></i>
                                    {{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? 'Hapus Favorit' : 'Tambah Favorit' }}
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Sinopsis -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Sinopsis</h2>
            <p class="text-gray-700 leading-relaxed">{{ $film->sinopsis }}</p>
        </div>

        <!-- Aktor -->
        @if($film->aktor)
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Pemeran</h2>
            <p class="text-gray-700">{{ $film->aktor }}</p>
        </div>
        @endif

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg inline-flex items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
