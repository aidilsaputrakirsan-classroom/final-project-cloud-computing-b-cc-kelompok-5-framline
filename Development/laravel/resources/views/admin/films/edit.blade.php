@extends('layouts.app')

@section('content')
<div class="p-8">
  <h1 class="text-2xl font-bold mb-6">✏️ Edit Film</h1>

  <form action="{{ route('admin.films.update', $film) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label>Poster Film</label>
      @if($film->poster)
        <img src="{{ asset('storage/'.$film->poster) }}" class="w-24 h-32 mb-2">
      @endif
      <input type="file" name="poster" class="block w-full border rounded p-2">
    </div>

    <div>
      <label>Judul Film</label>
      <input type="text" name="judul" value="{{ $film->judul }}" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Sinopsis</label>
      <textarea name="sinopsis" rows="4" class="block w-full border rounded p-2" required>{{ $film->sinopsis }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label>Tahun Rilis</label>
        <input type="number" name="tahun_rilis" value="{{ $film->tahun_rilis }}" class="block w-full border rounded p-2" required>
      </div>
      <div>
        <label>Durasi (menit)</label>
        <input type="text" name="durasi" value="{{ $film->durasi }}" class="block w-full border rounded p-2" required>
      </div>
    </div>

    <div>
      <label>Sutradara</label>
      <input type="text" name="sutradara" value="{{ $film->sutradara }}" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Aktor</label>
      <input type="text" name="aktor" value="{{ $film->aktor }}" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Genre</label>
      <select name="genre_id" class="block w-full border rounded p-2" required>
        @foreach ($genres as $genre)
          <option value="{{ $genre->id }}" {{ $genre->id == $film->genre_id ? 'selected' : '' }}>
            {{ $genre->nama }}
          </option>
        @endforeach
      </select>
    </div>

    <button class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Perbarui</button>
  </form>
</div>
@endsection
