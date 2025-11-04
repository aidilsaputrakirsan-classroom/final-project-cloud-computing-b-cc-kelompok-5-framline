@extends('layouts.app')

@section('content')
<div class="p-8">
  <h1 class="text-2xl font-bold mb-6">➕ Tambah Film Baru</h1>

  <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
      <label>Poster Film</label>
      <input type="file" name="poster" class="block w-full border rounded p-2">
    </div>

    <div>
      <label>Judul Film</label>
      <input type="text" name="judul" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Sinopsis</label>
      <textarea name="sinopsis" rows="4" class="block w-full border rounded p-2" required></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label>Tahun Rilis</label>
        <input type="number" name="tahun_rilis" class="block w-full border rounded p-2" required>
      </div>
      <div>
        <label>Durasi (menit)</label>
        <input type="text" name="durasi" class="block w-full border rounded p-2" required>
      </div>
    </div>

    <div>
      <label>Sutradara</label>
      <input type="text" name="sutradara" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Aktor</label>
      <input type="text" name="aktor" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Genre</label>
      <select name="genre_id" class="block w-full border rounded p-2" required>
        <option value="">-- Pilih Genre --</option>
        @foreach ($genres as $genre)
          <option value="{{ $genre->id }}">{{ $genre->nama }}</option>
        @endforeach
      </select>
    </div>

    <button class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Simpan</button>
  </form>
</div>
@endsection
