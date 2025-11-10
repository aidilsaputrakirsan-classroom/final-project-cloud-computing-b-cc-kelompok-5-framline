@extends('layouts.app')

@section('title', 'Genre - Cinema XXI')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center justify-start pt-24 pb-16">
    <h1 class="text-4xl font-bold text-teal-700 mb-8">Genre Film</h1>

    {{-- Tombol Tambah Genre untuk Admin --}}
    <div class="mb-8">
        <a href="{{ route('admin.genres.create') }}"
           class="bg-teal-700 text-dark px-5 py-2 rounded-full hover:bg-teal-800 transition">
           + Tambah Genre
        </a>
    </div>

    {{-- Grid Card Genre --}}
    <div id="genre-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 w-10/12">
        @foreach($genres->take(5) as $genre)
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition duration-300">
                <div class="p-5 flex flex-col justify-between h-full">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $genre->name }}</h2>
                        <p class="text-gray-600 text-sm">{{ $genre->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('admin.genres.edit', $genre->id) }}"
                           class="text-teal-700 font-medium hover:underline">Edit</a>
                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Yakin hapus genre ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
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
                    class="bg-gray-200 text-teal-700 font-semibold px-5 py-2 rounded-full hover:bg-gray-300 transition">
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
                if (!showingAll) {
                    genreList.innerHTML = allGenres.map(genre => `
                        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition duration-300">
                            <div class="p-5 flex flex-col justify-between h-full">
                                <div>
                                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">${genre.name}</h2>
                                    <p class="text-gray-600 text-sm">${genre.description ?? 'Tidak ada deskripsi'}</p>
                                </div>
                                <div class="mt-6 flex justify-between">
                                    <a href="/admin/genres/${genre.id}/edit" class="text-teal-700 font-medium hover:underline">Edit</a>
                                    <form method="POST" action="/admin/genres/${genre.id}" onsubmit="return confirm('Yakin hapus genre ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `).join('');

                    showMoreBtn.textContent = 'Sembunyikan';
                    showingAll = true;
                } else {
                    // Kembalikan ke 5 genre pertama
                    genreList.innerHTML = allGenres.slice(0, 5).map(genre => `
                        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition duration-300">
                            <div class="p-5 flex flex-col justify-between h-full">
                                <div>
                                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">${genre.name}</h2>
                                    <p class="text-gray-600 text-sm">${genre.description ?? 'Tidak ada deskripsi'}</p>
                                </div>
                                <div class="mt-6 flex justify-between">
                                    <a href="/admin/genres/${genre.id}/edit" class="text-teal-700 font-medium hover:underline">Edit</a>
                                    <form method="POST" action="/admin/genres/${genre.id}" onsubmit="return confirm('Yakin hapus genre ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `).join('');

                    showMoreBtn.textContent = 'Lihat Semua';
                    showingAll = false;
                }
            });
        }
    });
</script>
@endsection
