@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3>Daftar Film</h3>
  <a href="{{ route('admin.films.create') }}" class="btn btn-primary">+ Tambah Film</a>
</div>

<table class="table table-striped table-bordered align-middle">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>Judul</th>
      <th>Sutradara</th>
      <th>Durasi</th>
      <th>Tanggal Rilis</th>
      <th>Genre</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($films as $film)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $film->title }}</td>
        <td>{{ $film->director ?? '-' }}</td>
        <td>{{ $film->duration ? $film->duration . ' menit' : '-' }}</td>
        <td>{{ $film->release_date?->format('d M Y') ?? '-' }}</td>
        <td>
          @foreach($film->genres as $g)
            <span class="badge bg-secondary">{{ $g->name }}</span>
          @endforeach
        </td>
        <td>
          <a href="{{ route('films.show', $film) }}" class="btn btn-sm btn-outline-info">Lihat</a>
          <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('admin.films.destroy', $film) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus film ini?')">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7" class="text-center">Belum ada film.</td></tr>
    @endforelse
  </tbody>
</table>
@endsection
