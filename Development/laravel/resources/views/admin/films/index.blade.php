@extends('layouts.app')
@section('title', 'Admin - Kelola Film')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background: radial-gradient(circle at top, #141414 0%, #000 100%);
        color: #fff;
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    h1, h2, th {
        color: #fff;
    }

    .table-container {
        background: rgba(20, 20, 20, 0.95);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(229, 9, 20, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(6px);
    }

    .add-btn {
        background: #e50914;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .add-btn:hover {
        background: #b00610;
        transform: translateY(-2px);
        box-shadow: 0 0 15px rgba(229, 9, 20, 0.4);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 12px;
        overflow: hidden;
    }

    thead {
        background: rgba(229, 9, 20, 0.1);
    }

    th, td {
        padding: 12px 16px;
        text-align: left;
    }

    tbody tr {
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
    }

    tbody tr:hover {
        background: rgba(229, 9, 20, 0.15);
        transform: scale(1.01);
    }

    .poster-img {
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        transition: all 0.3s ease;
    }

    .poster-img:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(229, 9, 20, 0.4);
    }

    /* 🔥 Tombol Edit & Hapus */
    .action-btn {
        padding: 6px 14px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: linear-gradient(90deg, #2196f3, #1976d2);
        color: #fff;
        box-shadow: 0 0 10px rgba(33, 150, 243, 0.3);
    }

    .btn-edit:hover {
        background: linear-gradient(90deg, #42a5f5, #1e88e5);
        box-shadow: 0 0 20px rgba(33, 150, 243, 0.5);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: linear-gradient(90deg, #e50914, #b00610);
        color: #fff;
        box-shadow: 0 0 10px rgba(229, 9, 20, 0.4);
    }

    .btn-delete:hover {
        background: linear-gradient(90deg, #ff0f1f, #e50914);
        box-shadow: 0 0 20px rgba(229, 9, 20, 0.6);
        transform: translateY(-2px);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fadeInUp {
        animation: fadeInUp 0.8s ease forwards;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen px-8 py-10 fadeInUp">

    <h1 class="text-3xl font-bold mb-8 text-red-600 flex items-center gap-2">
        <i class="bi bi-film text-red-600"></i> Kelola Film
    </h1>

    <a href="{{ route('admin.films.create') }}" class="add-btn inline-block mb-6">
        + Tambah Film
    </a>

    @if(session('success'))
        <div class="bg-green-800 text-green-100 p-3 rounded mb-6 border border-green-500">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container overflow-x-auto">
        <table>
            <thead>
                <tr class="text-sm uppercase tracking-wider">
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Sinopsis</th>
                    <th>Tahun Rilis</th>
                    <th>Sutradara</th>
                    <th>Aktor</th>
                    <th>Durasi</th>
                    <th>Genre</th>
                    <th>Trailer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr>
                        <td>
                            @if ($film->poster)
                                <img src="{{ asset('storage/'.$film->poster) }}" class="w-16 h-20 object-cover poster-img">
                            @else
                                <span class="text-gray-500 text-sm italic">No Poster</span>
                            @endif
                        </td>
                        <td class="font-semibold text-white">{{ $film->judul }}</td>
                        <td class="text-gray-400 text-sm max-w-xs truncate" title="{{ $film->sinopsis }}">
                            {{ Str::limit($film->sinopsis, 100) }}
                        </td>
                        <td class="text-gray-300">{{ $film->tahun_rilis }}</td>
                        <td class="text-gray-300">{{ $film->sutradara }}</td>
                        <td class="text-gray-300">{{ $film->aktor }}</td>
                        <td class="text-gray-300">{{ $film->durasi }} menit</td>
                        <td class="text-gray-300">{{ $film->genre->name ?? '-' }}</td>
                        <td class="text-gray-300">
                            @if($film->trailer_url)
                                <span class="text-green-400">✓ Ada</span>
                            @else
                                <span class="text-red-400">✗ Tidak Ada</span>
                            @endif
                        </td>
                        <td class="space-x-2 flex items-center">
                            <a href="{{ route('admin.films.edit', $film) }}" class="action-btn btn-edit">Edit</a>
                            <form action="{{ route('admin.films.destroy', $film) }}" method="POST" onsubmit="return confirm('Yakin hapus film ini?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
