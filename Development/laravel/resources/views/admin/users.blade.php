@extends('layouts.app')

@section('title', 'Admin - Kelola Pengguna')

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

    .action-btn {
        padding: 6px 14px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
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

    .btn-save {
        background: linear-gradient(90deg, #2196f3, #1976d2);
        color: #fff;
        box-shadow: 0 0 10px rgba(33, 150, 243, 0.3);
    }

    .btn-save:hover {
        background: linear-gradient(90deg, #42a5f5, #1e88e5);
        box-shadow: 0 0 20px rgba(33, 150, 243, 0.5);
        transform: translateY(-2px);
    }

    .input-dark {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        color: #fff;
        border-radius: 6px;
        padding: 8px 10px;
        width: 100%;
    }

    .input-dark:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 0 0 8px rgba(229, 9, 20, 0.5);
    }

    select {
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 6px;
        padding: 4px 8px;
    }

    select:focus {
        outline: none;
        border-color: #e50914;
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

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-red-600 flex items-center gap-2">
            <i class="bi bi-people-fill text-red-600"></i> Kelola Pengguna
        </h1>
        <a href="{{ route('admin.dashboard') }}" class="add-btn bg-gray-700 hover:bg-gray-600">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-800 text-green-100 p-3 rounded mb-6 border border-green-500">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Pengguna --}}
    <div class="table-container mb-10">
        <h2 class="text-xl font-semibold mb-4 text-white flex items-center gap-2">
            ➕ Tambah Pengguna Baru
        </h2>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="text-sm text-gray-300">Nama</label>
                    <input type="text" name="name" id="name" required class="input-dark">
                </div>
                <div>
                    <label for="email" class="text-sm text-gray-300">Email</label>
                    <input type="email" name="email" id="email" required class="input-dark">
                </div>
                <div>
                    <label for="password" class="text-sm text-gray-300">Password</label>
                    <input type="password" name="password" id="password" required class="input-dark">
                </div>
                <div>
                    <label for="password_confirmation" class="text-sm text-gray-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="input-dark">
                </div>
                <div class="md:col-span-2 flex items-center">
                    <input type="checkbox" name="is_admin" value="1" class="mr-2 accent-red-600">
                    <span class="text-sm text-gray-300">Admin</span>
                </div>
            </div>

            <button type="submit" class="btn-save mt-2">Tambah Pengguna</button>
        </form>
    </div>

    {{-- Daftar Pengguna --}}
    <div class="table-container overflow-x-auto">
        <h2 class="text-xl font-semibold mb-4 text-white">Daftar Pengguna</h2>

        <table>
            <thead>
                <tr class="text-sm uppercase tracking-wider">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="font-semibold text-white">{{ $user->name }}</td>
                        <td class="text-gray-300">{{ $user->email }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit()">
                                    <option value="user" {{ !$user->is_admin ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                        </td>
                        <td class="text-gray-400">{{ optional($user->created_at)->format('d M Y') }}</td>
                        <td>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Yakin hapus pengguna ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete">Hapus</button>
                                </form>
                            @else
                                <span class="text-gray-500 text-sm italic">Tidak bisa hapus diri sendiri</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-8">Belum ada pengguna terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->links() : '' }}
        </div>
    </div>
</div>
@endsection
