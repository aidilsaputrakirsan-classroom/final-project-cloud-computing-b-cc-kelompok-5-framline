@extends('layouts.app')

@section('content')
<h2>Dashboard Admin</h2>

<div class="row text-center my-4">
  <div class="col-md-4">
    <div class="card p-3 bg-light shadow-sm">
      <h5>Total Film</h5>
      <h3>{{ $totalFilms }}</h3>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3 bg-light shadow-sm">
      <h5>Total Pengguna</h5>
      <h3>{{ $totalUsers }}</h3>
    </div>
  </div>
</div>

<h4 class="mt-5 mb-3">Aktivitas Terbaru</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Pengguna</th>
      <th>Aksi</th>
      <th>Film</th>
    </tr>
  </thead>
  <tbody>
    @foreach($recentLogs as $log)
      <tr>
        <td>{{ $log->performed_at->format('d M Y H:i') }}</td>
        <td>{{ $log->user?->name ?? '-' }}</td>
        <td>{{ ucfirst($log->action) }}</td>
        <td>{{ $log->film?->title ?? 'Film Dihapus' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
