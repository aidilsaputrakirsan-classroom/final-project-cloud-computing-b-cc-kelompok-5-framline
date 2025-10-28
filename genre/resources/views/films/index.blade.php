@extends('layouts.app')

@section('content')
<h2 class="mb-4">Daftar Film</h2>

<form class="row mb-4" method="GET" action="{{ route('films.search') }}">
  <div class="col-md-4">
    <input type="text" class="form-control" name="q" placeholder="Cari film..." value="{{ request('q') }}">
  </div>
  <div class="col-md-3">
    <select class="form-control" name="genre">
      <option value="">Semua Genre</option>
      @foreach($genres as $g)
        <option value="{{ $g->name }}" {{ request('genre')==$g->name?'selected':'' }}>{{ $g->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select class="form-control" name="sort">
      <option value="">Urutkan</option>
      <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Terbaru</option>
      <option value="duration_asc" {{ request('sort')=='duration_asc'?'selected':'' }}>Durasi Pendek</option>
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100">Terapkan</button>
  </div>
</form>

<div class="row">
  @forelse($films as $film)
    <div class="col-md-3 mb-4">
      <div class="card h-100 shadow-sm">
        @if($film->poster_url)
          <img src="{{ $film->poster_url }}" class="card-img-top" alt="Poster">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $film->title }}</h5>
          <p class="card-text text-muted small">{{ $film->release_date?->format('Y') }}</p>
          <a href="{{ route('films.show', $film) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center">Belum ada film.</p>
  @endforelse
</div>

{{ $films->links() }}
@endsection
