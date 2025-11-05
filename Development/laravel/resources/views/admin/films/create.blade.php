@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8 flex items-center gap-2">
      🎬 <span>Tambah Film Baru</span>
    </h1>

    <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <!-- Poster -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Poster Film</label>
        <input type="file" name="poster" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none">
      </div>

      <!-- Judul -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Judul Film</label>
        <input type="text" name="judul" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none" placeholder="Masukkan judul film..." required>
      </div>

      <!-- Sinopsis -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Sinopsis</label>
        <textarea name="sinopsis" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none resize-none" placeholder="Tulis sinopsis singkat..." required></textarea>
      </div>

      <!-- Tahun & Durasi -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-700 font-medium mb-2">Tahun Rilis</label>
          <input type="number" name="tahun_rilis" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none" placeholder="Contoh: 2024" required>
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-2">Durasi (menit)</label>
          <input type="text" name="durasi" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none" placeholder="Contoh: 120 menit" required>
        </div>
      </div>

      <!-- Sutradara -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Sutradara</label>
        <input type="text" name="sutradara" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none" placeholder="Nama sutradara..." required>
      </div>

      <!-- Aktor -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Aktor</label>
        <input type="text" name="aktor" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none" placeholder="Daftar aktor utama..." required>
      </div>

      <!-- Genre -->
      <div>
        <label class="block text-gray-700 font-medium mb-2">Genre</label>
        <select name="genre_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:outline-none" required>
          <option value="">-- Pilih Genre --</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->nama }}</option>
          @endforeach
        </select>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.films.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
          Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-teal-600 text-black rounded-lg font-medium hover:bg-teal-700 transition">
          Simpan Film
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
