@extends('layouts.app')

@section('title', 'Tambah Genre - Cinema XXI')

@section('content')
<div class="min-h-screen
    bg-white text-black
    dark:bg-gradient-to-b dark:from-black dark:via-[#141414] dark:to-[#1a1a1a] dark:text-white
    px-6 py-16 relative overflow-hidden">

  {{-- Background Overlay --}}
  <div class="absolute inset-0 bg-[url('/images/netflix-bg.jpg')] bg-cover bg-center opacity-10 dark:opacity-25"></div>
  <div class="absolute inset-0 bg-gradient-to-b from-white/80 to-white/90 dark:from-black/95 dark:via-black/80 dark:to-[#141414]"></div>

  <div class="relative z-10 max-w-lg mx-auto">
    <div class="mb-6">
      <a href="{{ route('admin.genres.index') }}"
         class="inline-flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2 text-sm font-semibold
                text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2
                focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
        ← Kembali ke Kelola Genre
      </a>
    </div>

    <h1 class="text-5xl font-extrabold mb-12 text-center
               text-red-600 dark:text-red-500
               tracking-wide drop-shadow-[0_0_25px_#dc2626]">
      ➕ Tambah Genre Baru
    </h1>

    <form action="{{ route('admin.genres.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-6
          bg-gray-100/70 dark:bg-black/70
          p-10 rounded-3xl
          shadow-[0_0_35px_rgba(220,38,38,0.3)]
          backdrop-blur-xl
          border border-red-800/20 dark:border-red-800/50
          transition-all duration-500
          hover:shadow-[0_0_50px_rgba(220,38,38,0.6)]">
      @csrf

      {{-- Nama Genre --}}
      <div>
        <label for="name" class="block
            text-gray-700 dark:text-gray-200
            font-semibold mb-2">Nama Genre</label>

        <input type="text"
               id="name"
               name="name"
               value="{{ old('name') }}"
               class="block w-full border
               border-gray-400 dark:border-red-800/60
               rounded-lg
               bg-gray-100 text-black
               dark:bg-[#0d0d0d] dark:text-white
               p-3
               placeholder-gray-500 dark:placeholder-gray-400
               selection:bg-red-600 selection:text-black
               focus:bg-white dark:focus:bg-black
               focus:text-black dark:focus:text-white
               focus:ring-2 focus:ring-red-600 focus:border-red-700
               transition-all duration-300"
               placeholder="Masukkan nama genre"
               required>

        @error('name')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Deskripsi Genre --}}
      <div>
        <label for="description" class="block
            text-gray-700 dark:text-gray-200
            font-semibold mb-2">Deskripsi Genre</label>

        <textarea id="description"
                  name="description"
                  rows="4"
                  class="block w-full border
                  border-gray-400 dark:border-red-800/60
                  rounded-lg
                  bg-gray-100 text-black
                  dark:bg-[#0d0d0d] dark:text-white
                  placeholder-gray-500 dark:placeholder-gray-400
                  p-3
                  selection:bg-red-600 selection:text-black
                  focus:bg-white dark:focus:bg-black
                  focus:text-black dark:focus:text-white
                  focus:ring-2 focus:ring-red-600 focus:border-red-700
                  transition-all duration-300"
                  placeholder="Masukkan deskripsi genre (opsional)">{{ old('description') }}</textarea>

        @error('description')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Gambar Genre --}}
      <div>
        <label for="image" class="block
            text-gray-700 dark:text-gray-200
            font-semibold mb-2">Gambar Genre</label>

        <input type="file"
               id="image"
               name="image"
               accept="image/*"
               class="block w-full border
               border-gray-400 dark:border-red-800/60
               rounded-lg
               bg-gray-200 text-black
               dark:bg-[#0d0d0d] dark:text-gray-200
               p-3
               focus:bg-white dark:focus:bg-black
               focus:ring-2 focus:ring-red-600 focus:border-red-700
               transition-all duration-300">

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Format: JPG, PNG. Maksimal 2MB.</p>

        @error('image')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol Aksi --}}
      <div class="flex space-x-4 pt-6">
        <a href="{{ route('admin.genres.index') }}"
           class="flex-1
           bg-gray-300 text-black
           dark:bg-gray-700 dark:text-white
           hover:bg-gray-400 dark:hover:bg-gray-800
           font-semibold py-3 px-4 rounded-lg text-center
           transition-all duration-300
           hover:shadow-[0_0_20px_rgba(107,114,128,0.6)]">
          Batal
        </a>

        <button type="submit"
                class="flex-1
                bg-red-600 hover:bg-red-700
                dark:bg-red-700 dark:hover:bg-red-800
                font-bold py-3 px-4 rounded-lg
                text-white
                shadow-[0_0_25px_rgba(220,38,38,0.6)]
                hover:shadow-[0_0_40px_rgba(220,38,38,0.9)]
                transition-all duration-300 transform hover:scale-105">
          💾 Simpan Genre
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
