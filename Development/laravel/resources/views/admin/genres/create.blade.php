@extends('layouts.app')

@section('title', 'Tambah Genre - Cinema XXI')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-black via-[#141414] to-[#1a1a1a] text-white px-6 py-16 relative overflow-hidden">

  {{-- Background Overlay --}}
  <div class="absolute inset-0 bg-[url('/images/netflix-bg.jpg')] bg-cover bg-center opacity-25"></div>
  <div class="absolute inset-0 bg-gradient-to-b from-black/95 via-black/80 to-[#141414]"></div>

  <div class="relative z-10 max-w-lg mx-auto">
    <h1 class="text-5xl font-extrabold mb-12 text-center text-red-600 tracking-wide drop-shadow-[0_0_25px_#dc2626]">
      ➕ Tambah Genre Baru
    </h1>

    <form action="{{ route('admin.genres.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-6 bg-black/70 p-10 rounded-3xl shadow-[0_0_35px_rgba(220,38,38,0.4)] backdrop-blur-xl border border-red-800/50 transition-all duration-500 hover:shadow-[0_0_50px_rgba(220,38,38,0.6)]">
      @csrf

      {{-- Nama Genre --}}
      <div>
        <label for="name" class="block text-gray-200 font-semibold mb-2">Nama Genre</label>
        <input type="text"
               id="name"
               name="name"
               value="{{ old('name') }}"
               class="block w-full border border-red-800/60 rounded-lg bg-[#f5f5f5] text-black p-3 selection:bg-red-600 selection:text-black focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300"
               placeholder="Masukkan nama genre"
               required>
        @error('name')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Deskripsi Genre --}}
      <div>
        <label for="description" class="block text-gray-200 font-semibold mb-2">Deskripsi Genre</label>
        <textarea id="description"
                  name="description"
                  rows="4"
                  class="block w-full border border-red-800/60 rounded-lg bg-[#f5f5f5] text-black p-3 selection:bg-red-600 selection:text-black focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300"
                  placeholder="Masukkan deskripsi genre (opsional)">{{ old('description') }}</textarea>
        @error('description')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Gambar Genre --}}
      <div>
        <label for="image" class="block text-gray-200 font-semibold mb-2">Gambar Genre</label>
        <input type="file"
               id="image"
               name="image"
               accept="image/*"
               class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300">
        <p class="mt-1 text-sm text-gray-400">Format: JPG, PNG. Maksimal 2MB.</p>
        @error('image')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol Aksi --}}
      <div class="flex space-x-4 pt-6">
        <a href="{{ route('admin.genres.index') }}"
           class="flex-1 bg-gray-700 hover:bg-gray-800 text-white font-semibold py-3 px-4 rounded-lg text-center transition-all duration-300 hover:shadow-[0_0_20px_rgba(107,114,128,0.6)]">
          Batal
        </a>
        <button type="submit"
                class="flex-1 bg-red-700 hover:bg-red-800 font-bold py-3 px-4 rounded-lg text-white shadow-[0_0_25px_rgba(220,38,38,0.6)] hover:shadow-[0_0_40px_rgba(220,38,38,0.9)] transition-all duration-300 transform hover:scale-105">
          💾 Simpan Genre
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
