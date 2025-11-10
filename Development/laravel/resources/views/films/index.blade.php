@extends('layouts.app')

@section('title', 'Film - Cinema XXI')

@section('content')
<div class="container mx-auto px-6 py-12 text-gray-100">

    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl font-extrabold mb-4 tracking-wide text-white">Daftar Film</h1>
        <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
    </div>

    <!-- Filter -->
    <div class="bg-gradient-to-br from-[#0a0a0a]/70 to-[#1a1a1a]/60 backdrop-blur-md rounded-2xl p-6 shadow-2xl mb-12">
        <form method="GET" action="{{ route('films.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- Cari Film -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Cari Film</label>
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Masukkan judul film atau genre..."
                    class="w-full bg-[#141414] border border-transparent rounded-xl px-4 py-3 text-gray-200 focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                >
            </div>

            <!-- Genre -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Genre</label>
                <select 
                    name="genre"
                    class="w-full bg-[#141414] border border-transparent rounded-xl px-4 py-3 text-gray-200 focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                >
                    <option value="">Semua Genre</option>
                    @foreach($genres as $g)
                        <option value="{{ $g->name }}" {{ request('genre') == $g->name ? 'selected' : '' }}>
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tahun -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tahun</label>
                <select 
                    name="year"
                    class="w-full bg-[#141414] border border-transparent rounded-xl px-4 py-3 text-gray-200 focus:ring-2 focus:ring-red-600 focus:border-transparent transition"
                >
                    <option value="">Semua Tahun</option>
                    @foreach(range(date('Y'), date('Y') - 20) as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex gap-2 items-end">
                <button 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold w-full transition"
                    type="submit"
                >
                    Cari
                </button>

                <a href="{{ route('films.index') }}" 
                   class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-xl font-semibold w-full text-center transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Grid Film -->
    @if($films->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

            @foreach($films as $film)
                <div class="bg-[#121212] rounded-2xl overflow-hidden shadow-lg hover:shadow-red-600/30 transition-transform transform hover:-translate-y-1 group">

                    <!-- Poster -->
                    <div class="relative overflow-hidden">
                        @if($film->poster)
                            <img 
                                src="{{ asset('storage/' . $film->poster) }}" 
                                class="w-full h-64 object-cover transition duration-500 group-hover:scale-110 brightness-90 group-hover:brightness-100"
                            >
                        @else
                            <div class="w-full h-64 bg-gray-800 flex items-center justify-center">
                                <i class="bi bi-film text-5xl text-gray-600"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-white line-clamp-2 mb-1">{{ $film->judul }}</h3>
                        <p class="text-sm text-gray-400 mb-2">{{ $film->tahun_rilis }} • {{ $film->genre->name }}</p>
                        <p class="text-gray-300 text-sm line-clamp-3 mb-4">{{ Str::limit($film->sinopsis, 100) }}</p>

                        <a 
                            href="{{ route('films.show', $film) }}" 
                            class="block text-center w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition"
                        >
                            Lihat Detail
                        </a>
                    </div>

                </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-12 text-center">
            {{ $films->appends(request()->query())->links() }}
        </div>

    @else
        <div class="text-center py-20">
            <i class="bi bi-film text-7xl text-gray-600 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-400 mb-2">Tidak ada film ditemukan</h2>
            <p class="text-gray-500 mb-6">Coba ubah filter atau kembali ke halaman utama.</p>

            <a href="{{ route('landing') }}" 
               class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                Kembali ke Beranda
            </a>
        </div>
    @endif

</div>
@endsection
