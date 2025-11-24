@extends('layouts.app')

@section('title', 'Riwayat Tontonan')

@section('content')
<div class="container mx-auto px-4 py-10 text-gray-100">

    <h1 class="text-3xl font-extrabold mb-8 tracking-wide">
        Riwayat Tontonan
    </h1>

    @if($history->count() > 0)
        <div class="space-y-6">

            @foreach($history as $film)
                <div class="bg-[#1a1a1a] rounded-xl shadow-lg hover:shadow-red-500/20 transition-all overflow-hidden border border-white/5 backdrop-blur">

                    <div class="md:flex">

                        <!-- Poster -->
                        <div class="md:w-1/4 relative">
                            @if($film->poster)
                                <img src="{{ asset('storage/' . $film->poster) }}"
                                     class="w-full h-48 md:h-full object-cover brightness-90 hover:brightness-100 transition" />
                            @else
                                <div class="w-full h-48 md:h-full bg-gray-800 flex items-center justify-center">
                                    <i class="bi bi-film text-4xl text-gray-500"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Film info -->
                        <div class="md:w-3/4 p-5">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">

                                    <h3 class="font-bold text-xl mb-1 text-white tracking-tight">
                                        {{ $film->judul }}
                                    </h3>

                                    <p class="text-sm text-gray-400 mb-3">
                                        {{ $film->tahun_rilis }} • {{ $film->genre->name }} • {{ $film->sutradara }}
                                    </p>

                                    <p class="text-gray-300 text-sm line-clamp-2">
                                        {{ Str::limit($film->sinopsis, 160) }}
                                    </p>
                                </div>

                                <!-- Tanggal Ditonton -->
                                <div class="text-right ml-4">
                                    <p class="text-xs text-gray-500">Ditonton</p>
                                    <p class="font-medium text-sm text-gray-300">
                                        {{ \Carbon\Carbon::parse($film->pivot->watched_at)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('films.show', $film) }}"
                                   class="text-red-500 hover:text-red-400 text-sm font-semibold transition">
                                    Lihat Detail
                                </a>

                                <form action="{{ route('films.favorite', $film) }}" method="POST">
                                    @csrf

                                    @php
                                        $favorited = auth()->user()
                                            ->favoriteFilms()
                                            ->where('film_id', $film->id)
                                            ->exists();
                                    @endphp

                                    <button type="submit"
                                            class="text-sm font-medium flex items-center gap-1
                                            {{ $favorited ? 'text-red-500' : 'text-gray-300' }}
                                            hover:text-red-400 transition">

                                        <i class="bi bi-heart{{ $favorited ? '-fill' : '' }}"></i>
                                        {{ $favorited ? 'Hapus Favorit' : 'Tambah Favorit' }}
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    @else
        <div class="text-center py-16">
            <i class="bi bi-clock-history text-7xl text-gray-600 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-400 mb-2">Belum ada riwayat tontonan</h2>
            <p class="text-gray-500 mb-6">Mulai menonton film untuk melihat riwayat di sini.</p>

            <a href="{{ route('home') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                Jelajahi Film
            </a>
        </div>
    @endif
</div>
@endsection
