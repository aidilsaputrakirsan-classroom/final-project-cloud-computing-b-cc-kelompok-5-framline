@extends('layouts.app')

@section('content')
<h3 class="mb-4">Tambah Film Baru</h3>

<form action="{{ route('admin.films.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Judul Film</label>
    <input type="text" name="title" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4"></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Sutradara</label>
    <input type="text" name="director" class="form-control">
  </div>

  <div class="mb-3 row">
    <div class="col-md-6">
      <label class="form-label">Tanggal Rilis</label>
      <input type="date" name="release_date" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Durasi (menit)</label>
      <input type="number" name="duration" class="form-control">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Poster URL</label>
    <input type="url" name="poster_url" class="form-control" placeholder="https://example.com/poster.jpg">
  </div>

  <div class="mb-3">
    <label class="form-label">Trailer URL</label>
    <input type="url" name="trailer_url" class="form-control" placeholder="https://youtube.com/...">
  </div>

  <div class="mb-3">
    <label class="form-label">Genre</label>
    <div class="row">
      @foreach($genres as $genre)
        <div class="col-md-3">
          <label class="form-check-label">
            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="form-check-input">
            {{ $genre->name }}
          </label>
        </div>
      @endforeach
    </div>
  </div>

  <button class="btn btn-success">Simpan</button>
  <a href="{{ route('admin.films.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
