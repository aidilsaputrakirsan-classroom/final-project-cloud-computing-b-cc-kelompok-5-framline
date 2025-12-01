@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between gap-4 mb-4">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2 text-sm font-semibold
                      text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2
                      focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
                    🎬Kelola Film
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tambah, ubah, dan hapus data film yang tampil di aplikasi.
                </p>
            </div>

            <a href="{{ route('admin.films.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold
                      text-white shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2
                      focus:ring-teal-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                <span class="text-lg leading-none">＋</span>
                <span>Tambah Film</span>
            </a>
        </div>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800
                    dark:border-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm
                dark:border-gray-700 dark:bg-gray-900">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100 text-xs font-semibold uppercase tracking-wide text-gray-700
                               dark:bg-gray-800 dark:text-gray-300">
                        <th class="py-3 px-4 sm:px-6">Film</th>
                        <th class="py-3 px-4 sm:px-6">Genre</th>
                        <th class="py-3 px-4 sm:px-6">Tahun</th>
                        <th class="py-3 px-4 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($films as $film)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            {{-- Poster + judul --}}
                            <td class="py-3 px-4 sm:px-6">
                                <div class="flex items-center gap-4">
                                    @if ($film->poster)
                                        <img src="{{ asset('storage/'.$film->poster) }}"
                                             class="h-20 w-16 rounded-md object-cover border border-gray-200 dark:border-gray-700"
                                             alt="{{ $film->judul }}">
                                    @else
                                        <div class="flex h-20 w-16 items-center justify-center rounded-md border
                                                    border-dashed border-gray-300 text-[11px] text-gray-400
                                                    dark:border-gray-700 dark:text-gray-500">
                                            No poster
                                        </div>
                                    @endif

                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $film->judul }}
                                        </div>
                                        @if(!empty($film->sinopsis))
                                            <p class="mt-1 line-clamp-2 text-xs text-gray-500 dark:text-gray-400">
                                                {{ $film->sinopsis }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Genre --}}
                            <td class="py-3 px-4 sm:px-6 align-middle">
                                @if($film->genre)
                                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium
                                                 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-200">
                                        {{ $film->genre->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                                @endif
                            </td>

                            {{-- Tahun --}}
                            <td class="py-3 px-4 sm:px-6 align-middle">
                                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium
                                             text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                    {{ $film->tahun_rilis }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="py-3 px-4 sm:px-6 align-middle">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.films.edit', $film) }}"
                                       class="inline-flex items-center rounded-lg border border-blue-500 px-3 py-1.5
                                              text-xs font-semibold text-blue-600 hover:bg-blue-50
                                              dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/40">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.films.destroy', $film) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin hapus film ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center rounded-lg border border-red-500 px-3 py-1.5
                                                       text-xs font-semibold text-red-600 hover:bg-red-50
                                                       dark:border-red-400 dark:text-red-300 dark:hover:bg-red-900/40">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="py-6 px-4 sm:px-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                Belum ada film yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
