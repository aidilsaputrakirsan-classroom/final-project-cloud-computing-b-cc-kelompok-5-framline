@extends('layouts.app')

@section('title', 'Admin - Kelola Pengguna')

@section('content')
<div class="min-h-screen px-8 py-10 fadeInUp 
            bg-gray-100 dark:bg-black 
            text-gray-900 dark:text-white">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold flex items-center gap-2 text-red-600 dark:text-red-500">
            <i class="bi bi-people-fill"></i> Kelola Pengguna
        </h1>
        <a href="{{ route('admin.dashboard') }}"
           class="add-btn px-4 py-2 rounded-lg font-semibold
                  bg-red-600 text-white
                  hover:bg-red-700 transition">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="p-3 mb-6 rounded border
                    bg-green-100 text-green-700
                    dark:bg-green-900 dark:text-green-200 dark:border-green-600">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD FORM TAMBAH USER --}}
    <div class="mb-10 p-6 rounded-xl shadow-lg border
                bg-white/70 dark:bg-gray-900/60
                backdrop-blur-md
                border-gray-300 dark:border-gray-700">

        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 
                   text-gray-900 dark:text-white">
            ➕ Tambah Pengguna Baru
        </h2>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nama --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="name" required
                        class="w-full px-3 py-2 rounded-md
                               bg-white dark:bg-gray-800
                               border border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-white
                               focus:ring-2 focus:ring-red-600 focus:border-red-600">
                </div>

                {{-- Email --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" required
                        class="w-full px-3 py-2 rounded-md
                               bg-white dark:bg-gray-800
                               border border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-white
                               focus:ring-2 focus:ring-red-600 focus:border-red-600">
                </div>

                {{-- Password --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-3 py-2 rounded-md
                               bg-white dark:bg-gray-800
                               border border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-white
                               focus:ring-2 focus:ring-red-600 focus:border-red-600">
                </div>

                {{-- Konfirmasi --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-3 py-2 rounded-md
                               bg-white dark:bg-gray-800
                               border border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-white
                               focus:ring-2 focus:ring-red-600 focus:border-red-600">
                </div>

                {{-- Checkbox Admin --}}
                <div class="md:col-span-2 flex items-center">
                    <input type="checkbox" name="is_admin" value="1"
                           class="mr-2 accent-red-600 dark:accent-red-500">
                    <span class="text-sm text-gray-700 dark:text-gray-300">Admin</span>
                </div>

            </div>

            {{-- Tombol Simpan --}}
            <button type="submit"
                class="mt-2 px-5 py-2 rounded-md font-semibold
                       bg-blue-600 text-white
                       hover:bg-blue-700 transition shadow-md">
                Tambah Pengguna
            </button>
        </form>
    </div>

    {{-- TABLE USER --}}
    <div class="rounded-xl shadow-lg border overflow-x-auto
                bg-white/70 dark:bg-gray-900/60
                backdrop-blur-md
                border-gray-300 dark:border-gray-700">

        <h2 class="text-xl font-semibold mb-4 p-6 pb-2
                   text-gray-900 dark:text-white">Daftar Pengguna</h2>

        <table class="w-full border-collapse">
            <thead class="bg-red-100 dark:bg-red-900/40">
                <tr class="text-sm uppercase tracking-wider text-gray-800 dark:text-gray-200">
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-left">Dibuat</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr class="border-t border-gray-200 dark:border-gray-700
                               hover:bg-red-50 dark:hover:bg-red-900/30 transition">

                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $user->email }}</td>

                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}">
                                @csrf @method('PUT')
                                <select name="role" onchange="this.form.submit()"
                                    class="rounded px-2 py-1
                                           bg-gray-200 dark:bg-gray-800
                                           text-gray-800 dark:text-gray-200
                                           border border-gray-300 dark:border-gray-700">
                                    <option value="user" {{ !$user->is_admin ? 'selected' : '' }}>
                                        User
                                    </option>
                                    <option value="admin" {{ $user->is_admin ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>
                            </form>
                        </td>

                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                            {{ optional($user->created_at)->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Yakin hapus pengguna ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 rounded-full font-semibold text-sm
                                               bg-red-600 hover:bg-red-700
                                               text-white transition">
                                        Hapus
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 text-sm italic">
                                    Tidak bisa hapus diri sendiri
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center text-gray-500 dark:text-gray-400 py-8">
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-6">
            {{ $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->links() : '' }}
        </div>
    </div>
</div>
@endsection
