@extends('layouts.app')

@section('title', 'Film Favorit Saya')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Film Favorit Saya</h1>

        @if($favorites->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($favorites as $film)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <!-- Poster -->
                        <div class="aspect-w-2 aspect-h-3">
                            @if($film->poster)
                                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="bi bi-film text-4xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Film Info -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $film->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $film->tahun_rilis }} • {{ $film->genre->name }}</p>
                            <p class="text-sm text-gray-700 line-clamp-3">{{ Str::limit($film->sinopsis, 100) }}</p>

                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('films.show', $film) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Detail
                                </a>
                                <form action="{{ route('films.favorite', $film) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        <i class="bi bi-heart-fill"></i> Hapus Favorit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="bi bi-heart text-6xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Belum ada film favorit</h2>
                <p class="text-gray-500 mb-6">Temukan film menarik dan tambahkan ke favorit Anda.</p>
                <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Jelajahi Film
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
