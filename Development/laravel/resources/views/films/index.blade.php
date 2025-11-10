@extends('layouts.app')

@section('title', 'Film - Cinema XXI')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Film</h1>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <form method="GET" action="{{ route('films.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-0">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Film</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Masukkan judul film atau genre..." class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 px-3 py-2">
                    </div>

                    <div class="flex-1 min-w-0">
                        <label for="genre" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                        <select name="genre" id="genre" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Semua Genre</option>
                            @foreach($genres as $g)
                                <option value="{{ $g->name }}" {{ request('genre') == $g->name ? 'selected' : '' }}>{{ $g->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1 min-w-0">
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select name="year" id="year" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Semua Tahun</option>
                            @foreach (range(date('Y'), date('Y') - 20) as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-teal-700 text-dark px-6 py-2 rounded-lg">
                            Cari
                        </button>
                        <a href="{{ route('films.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Film Grid -->
        @if($films->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($films as $film)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <!-- Poster -->
                        <div class="aspect-w-2 aspect-h-3">
                            @if($film->poster)
                                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->judul }}" class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <i class="bi bi-film text-4xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Film Info -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $film->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $film->tahun_rilis }} • {{ $film->genre->name }}</p>
                            <p class="text-sm text-gray-700 line-clamp-3 mb-4">{{ Str::limit($film->sinopsis, 100) }}</p>

                            <a href="{{ route('films.show', $film) }}" class="w-full bg-teal-600 hover:bg-teal-700 text-white text-center py-2 px-4 rounded-lg block transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $films->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="bi bi-film text-6xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada film ditemukan</h2>
                <p class="text-gray-500 mb-6">Coba ubah filter atau kembali ke halaman utama.</p>
                <a href="{{ route('landing') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
