@extends('layouts.app')

@section('title', 'Genre - Netflix Style')

@section('content')
<div class="min-h-screen bg-black text-white flex flex-col items-center justify-start pt-24 pb-16 font-sans">
    <h1 class="text-4xl font-extrabold text-red-600 mb-8 tracking-wide drop-shadow-[0_0_25px_#dc2626]">🎬 Genre Film</h1>

    {{-- Tombol Tambah Genre untuk Admin --}}
    <div class="mb-8">
        <a href="{{ route('admin.genres.create') }}"
           class="bg-red-600 text-white px-5 py-2 rounded-md font-semibold hover:bg-red-700 hover:shadow-[0_0_15px_#dc2626] transition-all duration-300">
           + Tambah Genre
        </a>
    </div>

    {{-- Grid Card Genre --}}
    <div id="genre-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 w-11/12">
        @foreach($genres->take(5) as $genre)
            <div class="relative group rounded-xl overflow-hidden shadow-lg transition transform hover:scale-105 hover:shadow-[0_0_30px_rgba(220,38,38,0.6)]">
                @if($genre->image)
                    <img src="{{ asset('storage/' . $genre->image) }}" alt="{{ $genre->name }}"
                         class="w-full h-64 object-cover opacity-80 group-hover:opacity-100 transition duration-300">
                @else
                    <div class="w-full h-64 bg-gradient-to-b from-gray-800 to-black flex items-center justify-center text-5xl font-bold text-red-600">
                        {{ strtoupper(substr($genre->name, 0, 1)) }}
                    </div>
                @endif

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent flex flex-col justify-end p-4 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    <h2 class="text-2xl font-bold mb-2 text-red-500 drop-shadow-[0_0_10px_#dc2626]">{{ $genre->name }}</h2>
                    <p class="text-sm text-gray-300 mb-4">{{ $genre->description ?? 'Tidak ada deskripsi' }}</p>

                    {{-- Tombol Edit & Hapus --}}
                    <div class="flex justify-between items-center space-x-3">
                        <a href="{{ route('admin.genres.edit', $genre->id) }}"
                           class="flex-1 text-center bg-gradient-to-r from-red-700 to-red-600 text-white text-sm font-bold py-2 rounded-lg hover:from-red-600 hover:to-red-500 hover:shadow-[0_0_20px_#dc2626] transition-all duration-300 transform hover:scale-105">
                           ✏️ Edit
                        </a>

                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus genre ini?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-gray-700 to-gray-600 text-white text-sm font-bold py-2 rounded-lg hover:from-red-800 hover:to-red-700 hover:shadow-[0_0_20px_#dc2626] transition-all duration-300 transform hover:scale-105">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Tombol Lihat Semua --}}
    @if($genres->count() > 5)
        <div class="mt-10">
            <button id="show-more"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md transition hover:shadow-[0_0_20px_#dc2626]">
                Lihat Semua
            </button>
        </div>
    @endif
</div>

{{-- Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showMoreBtn = document.getElementById('show-more');
        const genreList = document.getElementById('genre-list');
        let showingAll = false;
        const allGenres = @json($genres);

        if (showMoreBtn) {
            showMoreBtn.addEventListener('click', () => {
                const displayed = showingAll ? allGenres.slice(0, 5) : allGenres;
                genreList.innerHTML = displayed.map(genre => `
                    <div class="relative group rounded-xl overflow-hidden shadow-lg transition transform hover:scale-105 hover:shadow-[0_0_30px_rgba(220,38,38,0.6)]">
                        ${genre.image ? `
                            <img src="/storage/${genre.image}" alt="${genre.name}" class="w-full h-64 object-cover opacity-80 group-hover:opacity-100 transition duration-300">
                        ` : `
                            <div class="w-full h-64 bg-gradient-to-b from-gray-800 to-black flex items-center justify-center text-5xl font-bold text-red-600">
                                ${genre.name.charAt(0).toUpperCase()}
                            </div>
                        `}
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent flex flex-col justify-end p-4 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            <h2 class="text-2xl font-bold mb-2 text-red-500 drop-shadow-[0_0_10px_#dc2626]">${genre.name}</h2>
                            <p class="text-sm text-gray-300 mb-4">${genre.description ?? 'Tidak ada deskripsi'}</p>
                            <div class="flex justify-between items-center space-x-3">
                                <a href="/admin/genres/${genre.id}/edit" class="flex-1 text-center bg-gradient-to-r from-red-700 to-red-600 text-white text-sm font-bold py-2 rounded-lg hover:from-red-600 hover:to-red-500 hover:shadow-[0_0_20px_#dc2626] transition-all duration-300 transform hover:scale-105">
                                    ✏️ Edit
                                </a>
                                <form method="POST" action="/admin/genres/${genre.id}" onsubmit="return confirm('Yakin hapus genre ini?')" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-600 text-white text-sm font-bold py-2 rounded-lg hover:from-red-800 hover:to-red-700 hover:shadow-[0_0_20px_#dc2626] transition-all duration-300 transform hover:scale-105">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                `).join('');

                showMoreBtn.textContent = showingAll ? 'Lihat Semua' : 'Sembunyikan';
                showingAll = !showingAll;
            });
        }
    });
</script>
@endsection
