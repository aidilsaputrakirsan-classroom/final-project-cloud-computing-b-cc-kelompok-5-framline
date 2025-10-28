@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-4">
    @if($film->poster_url)
      <img src="{{ $film->poster_url }}" class="img-fluid rounded shadow" alt="">
    @endif
  </div>

  <div class="col-md-8">
    <h2>{{ $film->title }}</h2>
    <p><strong>Sutradara:</strong> {{ $film->director ?? '-' }}</p>
    <p><strong>Durasi:</strong> {{ $film->duration ?? 'N/A' }} menit</p>
    <p><strong>Tanggal Rilis:</strong> {{ $film->release_date?->format('d M Y') ?? '-' }}</p>

    <p class="mt-3">{{ $film->description }}</p>

    <div class="mb-3">
      <strong>Genre:</strong>
      @foreach($film->genres as $genre)
        <span class="badge bg-secondary">{{ $genre->name }}</span>
      @endforeach
    </div>

    @if($film->trailer_url)
      <div class="ratio ratio-16x9">
        <iframe src="{{ $film->trailer_url }}" allowfullscreen></iframe>
      </div>
    @endif
  </div>
</div>
@endsection
