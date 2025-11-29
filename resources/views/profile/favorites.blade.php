@extends('layouts.app')

@section('title', 'Film Favorit Saya')

@push('styles')
<style>
    body {
        background: #000;
        color: #fff;
        font-family: 'Inter', sans-serif;
        padding-top: 40px;
    }

    .netflix-title {
        font-size: 2.4rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 0 12px rgba(255,255,255,0.15);
        margin-bottom: 25px;
    }

    .film-card {
        background: rgba(20,20,20,0.9);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        overflow: hidden;
        transition: 0.3s ease;
        backdrop-filter: blur(6px);
    }

    .film-card:hover {
        transform: scale(1.03);
        border-color: #e50914;
        box-shadow: 0 0 25px rgba(229, 9, 20, 0.35);
    }

    .film-poster {
        height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .film-info {
        padding: 18px;
    }

    .film-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
    }

    .film-meta {
        color: #bbb;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }

    .film-sinopsis {
        font-size: 0.9rem;
        color: #ddd;
        opacity: 0.9;
    }

    .detail-btn {
        color: #e50914;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .remove-btn {
        background: transparent;
        color: #ff4e4e;
        border: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: 0.25s;
    }

    .remove-btn:hover {
        color: #e50914;
        text-shadow: 0 0 8px rgba(229, 9, 20, 0.5);
    }

    /* EMPTY STATE NETFLIX STYLE */
    .empty-icon {
        font-size: 4rem;
        color: #444;
    }

    .empty-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #bbb;
    }

    .empty-desc {
        color: #777;
        margin-bottom: 20px;
    }

    .explore-btn {
        background: #e50914;
        color: #fff;
        padding: 10px 22px;
        border-radius: 8px;
        transition: .25s;
    }

    .explore-btn:hover {
        background: #b40610;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">

    <h1 class="netflix-title">Film Favorit Saya</h1>

    @if($favorites->count() > 0)

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($favorites as $film)
                <div class="film-card">

                    <!-- Poster -->
                    @if($film->poster)
                        <img src="{{ asset('storage/' . $film->poster) }}" class="film-poster" alt="{{ $film->judul }}">
                    @else
                        <div class="w-full h-72 bg-gray-800 flex items-center justify-center">
                            <i class="bi bi-film text-4xl text-gray-500"></i>
                        </div>
                    @endif

                    <!-- Info -->
                    <div class="film-info">

                        <h3 class="film-title">{{ $film->judul }}</h3>

                        <p class="film-meta">
                            {{ $film->tahun_rilis }} • {{ $film->genre->name }}
                        </p>

                        <p class="film-sinopsis">
                            {{ Str::limit($film->sinopsis, 110) }}
                        </p>

                        <div class="mt-4 flex justify-between items-center">

                            <a href="{{ route('films.show', $film) }}" class="detail-btn">
                                Lihat Detail
                            </a>

                            <form action="{{ route('films.favorite', $film) }}" method="POST">
                                @csrf
                                <button type="submit" class="remove-btn">
                                    <i class="bi bi-heart-fill"></i> Hapus
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    @else
        <div class="text-center py-20">

            <i class="bi bi-heart-fill empty-icon"></i>

            <h2 class="empty-title mt-4">Belum ada film favorit</h2>

            <p class="empty-desc">Tambahkan film ke favoritmu dan nikmati rekomendasi personal.</p>

            <a href="{{ route('home') }}" class="explore-btn">
                Jelajahi Film
            </a>
        </div>
    @endif

</div>
@endsection
