@extends('layouts.app')

@section('content')
<h3 class="mb-4">Edit Film: {{ $film->title }}</h3>

<form action="{{ route('admin.films.update', $film) }}" method="POST">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Judul Film</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $film->title) }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $film->description) }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Sutradara</label>
    <input type="text" name="director" class="form-control" value="{{ old('director', $film->director) }}">
  </div>

  <div class="mb-3 row">
    <div class="col-md-6">
      <label class="form-label">Tanggal Rilis</label>
      <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $film->release_date) }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Durasi (menit)</label>
      <input type="number" name="duration" class="form-control" value="{{ old('duration', $film->duration) }}">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Poster URL</label>
    <input type="url" name="poster_url" class="form-control" value="{{ old('poster_url', $film->poster_url) }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Trailer URL</label>
    <input type="url" name="trailer_url" class="form-control" value="{{ old('trailer_url', $film->trailer_url) }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Genre</label>
    <div class="row">
      @foreach($genres as $genre)
        <div class="col-md-3">
          <label class="form-check-label">
            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="form-check-input"
              {{ in_array($genre->id, $film->genres->pluck('id')->toArray()) ? 'checked' : '' }}>
            {{ $genre->name }}
          </label>
        </div>
      @endforeach
    </div>
  </div>

  <button class="btn btn-success">Update</button>
  <a href="{{ route('admin.films.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
