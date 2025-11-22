@extends('layouts.app')

@section('title', $film->judul)

@push('styles')
<style>
    dialog#loginModal {
        background: #0d0d0d !important;
        color: #fff !important;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 0;
        width: 24rem;
        box-shadow: 0 0 40px rgba(0,0,0,0.7);
    }

    dialog#loginModal::backdrop {
        background: rgba(0,0,0,0.75);
        backdrop-filter: blur(2px);
    }

    .btn-click {
        transform: scale(0.95);
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-10 text-gray-100">

    <div class="max-w-5xl mx-auto">

        <!-- FILM HEADER -->
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl overflow-hidden shadow-2xl mb-10">

            <div class="md:flex">

                <!-- Poster -->
                <div class="md:w-1/3 relative overflow-hidden">
                    @if($film->poster)
                        <img
                            src="{{ asset('storage/' . $film->poster) }}"
                            class="w-full h-[450px] object-cover brightness-90 hover:brightness-100 transition-all duration-300"
                        >
                    @else
                        <div class="w-full h-96 bg-gray-800 flex items-center justify-center">
                            <i class="bi bi-film text-6xl text-gray-600"></i>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="md:w-2/3 p-8">

                    <h1 class="text-4xl font-extrabold tracking-wide mb-6">{{ $film->judul }}</h1>

                    <!-- Metadata -->
                    <div class="grid grid-cols-2 gap-6 mb-8 text-sm">

                        <div>
                            <p class="text-gray-400">Tahun Rilis</p>
                            <p class="text-lg font-semibold">{{ $film->tahun_rilis }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Durasi</p>
                            <p class="text-lg font-semibold">{{ $film->durasi ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Sutradara</p>
                            <p class="text-lg font-semibold">{{ $film->sutradara }}</p>
                        </div>

                        <div>
                            <p class="text-gray-400">Genre</p>
                            <p class="text-lg font-semibold">{{ $film->genre->name }}</p>
                        </div>

                    </div>

                    <!-- FAVORITE BUTTON -->
                    <div class="mt-4">

                        <button
                            id="favoriteBtn"
                            data-film-id="{{ $film->id }}"
                            data-auth="{{ auth()->check() ? '1' : '0' }}"
                            class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg text-white font-semibold text-sm flex items-center gap-2 transition"
                        >
                            <i id="favoriteIcon"
                               class="bi {{ auth()->check() && auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? 'bi-heart-fill' : 'bi-heart' }}">
                            </i>

                            <span id="favoriteText">
                                @auth
                                    {{ auth()->user()->favoriteFilms()->where('film_id', $film->id)->exists() ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                                @else
                                    Tambah ke Favorit
                                @endauth
                            </span>
                        </button>

                    </div>

                </div>
            </div>
        </div>

        <!-- SINOPSIS -->
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl p-8 shadow-lg mb-10">
            <h2 class="text-2xl font-bold mb-4">Sinopsis</h2>
            <p class="text-gray-300 leading-relaxed text-lg">
                {{ $film->sinopsis }}
            </p>
        </div>

        <!-- PEMERAN -->
        @if($film->aktor)
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl p-8 shadow-lg mb-10">
            <h2 class="text-2xl font-bold mb-4">Pemeran</h2>
            <p class="text-gray-300 text-lg">{{ $film->aktor }}</p>
        </div>
        @endif

        <!-- TRAILER -->
        @if($film->trailer_url)
        <div class="bg-[#0f0f0f] border border-white/10 rounded-2xl p-8 shadow-lg mb-10">
            <h2 class="text-2xl font-bold mb-4">Trailer</h2>

            <div class="mb-4">
                <a
                    href="{{ $film->trailer_watch_url }}"
                    target="_blank"
                    class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg text-white font-semibold text-sm inline-flex items-center gap-2 transition"
                >
                    <i class="bi bi-play-circle-fill"></i>
                    Tonton Trailer di YouTube
                </a>
            </div>

            @if($film->o_embed_html)
            <div class="aspect-video w-full rounded-xl overflow-hidden border border-white/10 shadow-lg">
                {!! $film->o_embed_html !!}
            </div>
            @endif
        </div>
        @endif

        <!-- BUTTON KEMBALI -->
        <div class="text-center mt-10 mb-10">
            <a
                href="{{ url()->previous() }}"
                class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg inline-flex items-center gap-2 font-semibold transition"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

    </div>
</div>

<!-- MODAL LOGIN -->
<dialog id="loginModal" class="rounded-xl">
    <form method="dialog" class="p-6 text-white">
        <h2 class="text-xl font-bold mb-4">Login Diperlukan</h2>

        <p class="text-gray-300 mb-6">
            Kamu harus login terlebih dahulu untuk menambahkan film ke dalam favorit.
        </p>

        <div class="flex justify-end gap-3">
            <button class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg">Tutup</button>
            <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg">Login</a>
        </div>
    </form>
</dialog>

@endsection

@push('scripts')
<script>
document.getElementById('favoriteBtn').addEventListener('click', async function () {

    const isAuth = this.dataset.auth;

    // Jika user BELUM login → tampilkan modal
    if (isAuth === "0") {
        document.getElementById('loginModal').showModal();
        return;
    }

    // Jika sudah login → jalankan AJAX toggle favorite
    const btn = this;
    const icon = document.getElementById('favoriteIcon');
    const text = document.getElementById('favoriteText');
    const filmId = btn.dataset.filmId;

    btn.classList.add("btn-click");
    setTimeout(() => btn.classList.remove("btn-click"), 150);

    const csrf = '{{ csrf_token() }}';

    const res = await fetch(`/films/${filmId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
        }
    });

    const data = await res.json();

    if (data.success) {
        if (data.favorited) {
            icon.classList.remove('bi-heart');
            icon.classList.add('bi-heart-fill');
            text.innerText = 'Hapus dari Favorit';
        } else {
            icon.classList.remove('bi-heart-fill');
            icon.classList.add('bi-heart');
            text.innerText = 'Tambah ke Favorit';
        }
    }
});
</script>
@endpush
