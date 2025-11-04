@extends('layouts.app')

@section('title', 'Riwayat Tontonan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Riwayat Tontonan</h1>

        @if($history->count() > 0)
            <div class="space-y-4">
                @foreach($history as $film)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="md:flex">
                            <!-- Poster -->
                            <div class="md:w-1/4">
                                @if($film->poster)
                                    <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-full h-32 md:h-full object-cover">
                                @else
                                    <div class="w-full h-32 md:h-full bg-gray-200 flex items-center justify-center">
                                        <i class="bi bi-film text-3xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Film Info -->
                            <div class="md:w-3/4 p-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $film->judul }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">{{ $film->tahun_rilis }} • {{ $film->genre->name }} • {{ $film->sutradara }}</p>
                                        <p class="text-sm text-gray-700 line-clamp-2">{{ Str::limit($film->sinopsis, 150) }}</p>
                                    </div>
                                    <div class="text-right ml-4">
                                        <p class="text-xs text-gray-500">Ditonton pada</p>
                                        <p class="text-sm font-medium">{{ $film->pivot->watched_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('films.show', $film) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Lihat Detail
                                    </a>
                                    <form action="{{ route('films.favorite', $film) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            <i class="bi bi-heart{{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? '-fill' : '' }}"></i>
                                            {{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? 'Hapus Favorit' : 'Tambah Favorit' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="bi bi-clock-history text-6xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Belum ada riwayat tontonan</h2>
                <p class="text-gray-500 mb-6">Mulai menonton film untuk melihat riwayat di sini.</p>
                <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Jelajahi Film
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
