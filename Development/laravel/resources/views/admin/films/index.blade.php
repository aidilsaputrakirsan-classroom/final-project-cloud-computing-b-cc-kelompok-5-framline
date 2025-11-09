@extends('layouts.app')

@section('content')
<div class="p-8">
  <h1 class="text-2xl font-bold mb-6">🎬 Kelola Film</h1>

  <a href="{{ route('admin.films.create') }}" class="bg-teal-600 text-dark px-4 py-2 rounded-lg mb-4 inline-block hover:bg-teal-700">+ Tambah Film</a>

  @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
  @endif

  <table class="min-w-full bg-white shadow rounded-xl">
    <thead class="bg-gray-200">
      <tr>
        <th class="py-2 px-4">Poster</th>
        <th class="py-2 px-4">Judul</th>
        <th class="py-2 px-4">Genre</th>
        <th class="py-2 px-4">Tahun</th>
        <th class="py-2 px-4">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($films as $film)
        <tr class="border-t">
          <td class="py-2 px-4">
            @if ($film->poster)
              <img src="{{ asset('storage/'.$film->poster) }}" class="w-16 h-20 object-cover rounded">
            @endif
          </td>
          <td class="py-2 px-4">{{ $film->judul }}</td>
          <td class="py-2 px-4">{{ $film->genre->name ?? '-' }}</td>
          <td class="py-2 px-4">{{ $film->tahun_rilis }}</td>
          <td class="py-2 px-4 space-x-2">
            <a href="{{ route('admin.films.edit', $film) }}" class="text-blue-600 hover:underline">Edit</a>
            <form action="{{ route('admin.films.destroy', $film) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus film ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
