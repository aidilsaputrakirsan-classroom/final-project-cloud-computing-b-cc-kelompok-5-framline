@extends('layouts.app')

@section('content')
<h3>Kelola Genre</h3>

<form action="{{ route('admin.genres.store') }}" method="POST" class="row g-3 mb-4">
  @csrf
  <div class="col-md-6">
    <input type="text" name="name" class="form-control" placeholder="Nama Genre Baru" required>
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100">Tambah</button>
  </div>
</form>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Genre</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($genres as $g)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $g->name }}</td>
        <td>
          <form action="{{ route('admin.genres.destroy', $g) }}" method="POST">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
