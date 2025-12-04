@extends('layouts.app')

@section('title', 'Film - Cinema XXI')

@push('styles')
<style>
    /* Input dan Select responsive terhadap dark mode */
    select:focus,
    input[type="text"]:focus {
        outline: none;
    }
</style>
@endpush


@section('content')
<div class="container mx-auto px-6 py-12 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">

    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-5xl font-extrabold mb-4 tracking-wide text-gray-900 dark:text-white">Daftar Film</h1>
        <div class="w-24 h-1 bg-red-600 mx-auto rounded-full"></div>
    </div>

    <!-- Filter -->
    <div class="bg-white dark:bg-gray-800 backdrop-blur-md rounded-2xl p-6 shadow-lg dark:shadow-black/50 mb-12 border border-gray-200 dark:border-gray-700">
        
        <form method="GET" action="{{ route('films.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- Cari Film -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Film</label>
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Masukkan judul film atau genre..."
                    class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-red-600 focus:border-red-600 transition">
            </div>

            <!-- Genre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Genre</label>
                <select name="genre"
                    class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-red-600 focus:border-red-600 transition">
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
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun</label>
                <select name="year"
                    class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-red-600 focus:border-red-600 transition">
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
                <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold w-full transition" 
                        type="submit">
                    Cari
                </button>
                <a href="{{ route('films.index') }}" 
                   class="bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-white px-6 py-3 rounded-xl font-semibold w-full text-center transition">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- Grid Film -->
    @if($films->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">
            @foreach($films as $film)
                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg dark:shadow-black/50 hover:shadow-red-600/30 transition-transform hover:-translate-y-1 group border border-gray-200 dark:border-gray-700">

                    <!-- Poster -->
                    <div class="relative overflow-hidden">
                        @if($film->poster)
                            <img src="{{ asset('storage/' . $film->poster) }}" 
                                 class="w-full h-64 object-cover transition duration-500 group-hover:scale-110 brightness-90 group-hover:brightness-100">
                        @else
                            <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <i class="bi bi-film text-5xl text-gray-400 dark:text-gray-600"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white line-clamp-2 mb-1">{{ $film->judul }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $film->tahun_rilis }} • {{ $film->genre->name }}</p>
                        <p class="text-gray-700 dark:text-gray-300 text-sm line-clamp-3 mb-4">{{ Str::limit($film->sinopsis, 100) }}</p>

                        <!-- Tombol Detail -->
                        <a href="{{ route('films.show', $film) }}" 
                           class="block text-center w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold transition mb-2">
                            Lihat Detail
                        </a>

                        <!-- Guest -->
                        @guest
                            <button onclick="requireLogin()" 
                                class="block text-center w-full bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-white py-2 rounded-lg font-semibold transition">
                                + Tambah ke Favorit
                            </button>
                        @endguest

                        <!-- Auth -->
                        @auth
                            <form action="{{ route('films.favorite', $film) }}" method="POST">
                                @csrf
                                <button class="block text-center w-full bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-white py-2 rounded-lg font-semibold transition">
                                    + Tambah ke Favorit
                                </button>
                            </form>
                        @endauth
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
            <i class="bi bi-film text-7xl text-gray-400 dark:text-gray-600 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">Tidak ada film ditemukan</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Coba ubah filter atau kembali ke halaman utama.</p>
            <a href="{{ route('landing') }}" 
               class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                Kembali ke Beranda
            </a>
        </div>
    @endif
</div>

<!-- Modal Login -->
<div id="loginModal" class="fixed inset-0 z-50 bg-black/70 hidden flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-2xl dark:shadow-black/70 text-center w-96 border border-gray-200 dark:border-gray-700">

        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Login Diperlukan</h2>
        <p class="text-gray-700 dark:text-gray-300 mb-6">
            Anda harus login terlebih dahulu untuk menambahkan film ke favorit.
        </p>

        <a href="{{ route('login') }}"
           class="block w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl mb-3 transition">
            Login Sekarang
        </a>

        <button onclick="closeLoginModal()" 
                class="block w-full bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-900 dark:text-white py-2 rounded-xl transition">
            Batal
        </button>

    </div>
</div>
@endsection


@section('scripts')
<script>
    function requireLogin() {
        document.getElementById('loginModal').classList.remove('hidden');
    }
    function closeLoginModal() {
        document.getElementById('loginModal').classList.add('hidden');
    }
</script>
@endsection
