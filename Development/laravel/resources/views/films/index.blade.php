@extends('layouts.app')

@section('title', 'Film - Cinema XXI')

@section('content')
<div class="container mx-auto px-4 py-10 text-gray-100">

    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold mb-6 tracking-wide">Daftar Film</h1>

        <!-- Filter (Netflix-style) -->
        <div class="bg-black/40 backdrop-blur-xl border border-white/10 rounded-xl p-6 shadow-lg">
            <form method="GET" action="{{ route('films.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- Search -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Cari Film</label>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Masukkan judul film atau genre..."
                        value="{{ request('search') }}"
                        class="w-full bg-[#0f0f0f] border border-white/10 rounded-lg px-3 py-2 text-gray-200 focus:ring-red-500 focus:border-red-500"
                    >
                </div>

                <!-- Genre -->
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Genre</label>
                    <select 
                        name="genre"
                        class="w-full bg-[#0f0f0f] border border-white/10 rounded-lg px-3 py-2 text-gray-200 focus:ring-red-500 focus:border-red-500"
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
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Tahun</label>
                    <select 
                        name="year"
                        class="w-full bg-[#0f0f0f] border border-white/10 rounded-lg px-3 py-2 text-gray-200 focus:ring-red-500 focus:border-red-500"
                    >
                        <option value="">Semua Tahun</option>
                        @foreach(range(date('Y'), date('Y') - 20) as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Button -->
                <div class="flex gap-2 items-end">
                    <button 
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold w-full transition"
                        type="submit"
                    >
                        Cari
                    </button>

                    <a href="{{ route('films.index') }}" 
                       class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg w-full font-semibold text-center transition">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Film Grid -->
    @if($films->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

            @foreach($films as $film)
                <div class="bg-[#0f0f0f] border border-white/10 rounded-xl overflow-hidden shadow-xl hover:shadow-red-500/20 transition-all group">

                    <!-- Poster -->
                    <div class="relative overflow-hidden">
                        @if($film->poster)
                            <img 
                                src="{{ asset('storage/' . $film->poster) }}" 
                                class="w-full h-64 object-cover rounded-t-xl transition duration-300 group-hover:scale-110 brightness-90 group-hover:brightness-100"
                            >
                        @else
                            <div class="w-full h-64 bg-gray-800 flex items-center justify-center">
                                <i class="bi bi-film text-5xl text-gray-500"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-white line-clamp-2 mb-1">
                            {{ $film->judul }}
                        </h3>

                        <p class="text-sm text-gray-400 mb-3">
                            {{ $film->tahun_rilis }} • {{ $film->genre->name }}
                        </p>

                        <p class="text-gray-300 text-sm line-clamp-3 mb-4">
                            {{ Str::limit($film->sinopsis, 100) }}
                        </p>

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
        <div class="mt-10">
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
