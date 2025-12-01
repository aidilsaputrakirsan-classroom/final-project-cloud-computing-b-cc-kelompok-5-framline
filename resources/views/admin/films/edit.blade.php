@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-gray-100 to-gray-200 
            dark:from-black dark:via-[#141414] dark:to-[#1a1a1a]
            text-black dark:text-white px-8 py-16 relative overflow-hidden">

  {{-- Background Cinematic Overlay --}}
  <div class="absolute inset-0 bg-[url('/images/netflix-bg.jpg')] bg-cover bg-center opacity-10 dark:opacity-25"></div>
  <div class="absolute inset-0 bg-gradient-to-b from-white/90 via-white/70 to-gray-200/80 
              dark:from-black/95 dark:via-black/80 dark:to-[#141414]"></div>

  <div class="relative z-10 max-w-3xl mx-auto">
    <h1 class="text-5xl font-extrabold mb-12 text-center text-red-600 tracking-wide drop-shadow-[0_0_20px_#dc2626]">
      🎬 Edit Film
    </h1>

    <form action="{{ route('admin.films.update', $film->id) }}" method="POST" enctype="multipart/form-data"
          class="space-y-6 
                 bg-white/70 dark:bg-black/70 
                 p-10 rounded-3xl 
                 shadow-[0_0_35px_rgba(220,38,38,0.4)] backdrop-blur-xl 
                 border border-red-800/50 
                 transition-all duration-500 
                 hover:shadow-[0_0_50px_rgba(220,38,38,0.6)]">
      @csrf
      @method('PUT')

      {{-- Poster --}}
      <div>
        <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Poster Film</label>
        <input type="file" name="poster"
               class="block w-full border border-red-800/60 rounded-lg 
                      bg-white dark:bg-[#0d0d0d]
                      text-black dark:text-white 
                      p-3 focus:ring-2 focus:ring-red-600 focus:border-red-700 transition">
        @if($film->poster)
          <img src="{{ asset('storage/' . $film->poster) }}" 
               class="mt-4 rounded-lg shadow-lg w-40 border border-red-700/60">
        @endif
      </div>

      {{-- Judul --}}
      <div>
        <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Judul Film</label>
        <input type="text" name="judul" value="{{ old('judul', $film->judul) }}"
               class="block w-full border border-red-800/60 rounded-lg 
                      bg-white dark:bg-[#0d0d0d]
                      text-black dark:text-white
                      p-3 focus:ring-2 focus:ring-red-600 focus:border-red-700 transition" required>
      </div>

      {{-- Sinopsis --}}
      <div>
        <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Sinopsis</label>
        <textarea name="sinopsis" rows="4"
                  class="block w-full border border-red-800/60 rounded-lg 
                         bg-white dark:bg-[#0d0d0d]
                         text-black dark:text-white
                         p-3 focus:ring-2 focus:ring-red-600 focus:border-red-700 transition" required>{{ old('sinopsis', $film->sinopsis) }}</textarea>
      </div>

      {{-- Tahun & Durasi --}}
      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Tahun Rilis</label>
          <input type="date" name="tahun_rilis" value="{{ old('tahun_rilis', $film->tahun_rilis) }}"
                 class="block w-full border border-red-800/60 rounded-lg 
                        bg-white dark:bg-[#0d0d0d]
                        text-black dark:text-white
                        p-3 focus:ring-2 focus:ring-red-600 transition" required>
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Durasi (menit)</label>
          <input type="text" name="durasi" value="{{ old('durasi', $film->durasi) }}"
                 class="block w-full border border-red-800/60 rounded-lg 
                        bg-white dark:bg-[#0d0d0d]
                        text-black dark:text-white
                        p-3 focus:ring-2 focus:ring-red-600 transition" required>
        </div>
      </div>

      {{-- Sutradara --}}
      <div>
        <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Sutradara</label>
        <input type="text" name="sutradara" value="{{ old('sutradara', $film->sutradara) }}"
               class="block w-full border border-red-800/60 rounded-lg
                      bg-white dark:bg-[#0d0d0d]
                      text-black dark:text-white
                      p-3 focus:ring-2 focus:ring-red-600 transition" required>
      </div>

      {{-- Aktor --}}
      <div>
        <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Aktor</label>
        <input type="text" name="aktor" value="{{ old('aktor', $film->aktor) }}"
               class="block w-full border border-red-800/60 rounded-lg
                      bg-white dark:bg-[#0d0d0d]
                      text-black dark:text-white
                      p-3 focus:ring-2 focus:ring-red-600 transition" required>
      </div>

      {{-- Trailer --}}
      <div>
        <label class="block font-semibold mb-2 text-gray-700 dark:text-gray-200">Trailer URL (YouTube)</label>
        <input type="text" name="trailer_url" value="{{ old('trailer_url', $film->trailer_url) }}"
               class="block w-full border border-red-800/60 rounded-lg
                      bg-white dark:bg-[#0d0d0d]
                      text-black dark:text-white
                      p-3 focus:ring-2 focus:ring-red-600 transition">
      </div>

      {{-- Genre --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Genre</label>
        <select name="genre_id" id="genre-select"
                class="block w-full border @error('genre_id') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
                bg-white dark:bg-[#0d0d0d]
                text-gray-900 dark:text-gray-200 p-3" required>
          <option value="">-- Pilih Genre --</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
          @endforeach
        </select>
        @error('genre_id')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol Update --}}
      <div class="pt-10 text-center">
        <button class="bg-red-700 hover:bg-red-800 px-10 py-3 rounded-xl font-bold 
                       text-white shadow-[0_0_30px_rgba(220,38,38,0.6)] hover:shadow-[0_0_50px_rgba(220,38,38,0.9)]
                       transition-transform duration-300 hover:scale-105">
          💾 Update Film
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
