@extends('layouts.app')

@section('title', 'Edit Genre - Netflix Style')

@section('content')
<div class="min-h-screen bg-white dark:bg-black flex flex-col items-center justify-start pt-24 pb-16 text-black dark:text-white font-sans">

    <div class="mb-6 w-full max-w-lg">
        <a href="{{ route('admin.genres.index') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2 text-sm font-semibold
                  text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2
                  focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
            ← Kembali ke Kelola Genre
        </a>
    </div>

    <div class="bg-gray-100 dark:bg-gradient-to-b dark:from-gray-900 dark:to-black shadow-2xl rounded-2xl p-10 w-full max-w-lg
                border border-gray-300 dark:border-red-700/30">

        <h1 class="text-4xl font-extrabold text-red-600 dark:text-red-500 mb-8 text-center tracking-wide">
            ✏️ Edit Genre
        </h1>

        <form action="{{ route('admin.genres.update', $genre) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Genre --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nama Genre</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $genre->name) }}"
                       class="block w-full px-4 py-3
                              bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-700
                              rounded-md
                              text-black dark:text-white
                              placeholder-gray-500 dark:placeholder-gray-400
                              focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                       placeholder="Masukkan nama genre"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi Genre --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Deskripsi Genre</label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          class="block w-full px-4 py-3
                                 bg-white dark:bg-gray-800
                                 border border-gray-300 dark:border-gray-700
                                 rounded-md
                                 text-black dark:text-white
                                 placeholder-gray-500 dark:placeholder-gray-400
                                 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 transition"
                          placeholder="Masukkan deskripsi genre (opsional)">{{ old('description', $genre->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar Genre --}}
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Poster Genre</label>
                @if($genre->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $genre->image) }}" alt="{{ $genre->name }}"
                             class="w-24 h-24 object-cover rounded-md border border-gray-300 dark:border-red-600/50 shadow-md">
                    </div>
                @endif
                <input type="file"
                       id="image"
                       name="image"
                       accept="image/*"
                       class="block w-full
                              text-black dark:text-gray-200
                              bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-700
                              rounded-md cursor-pointer
                              file:mr-3 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-red-600 file:text-white
                              hover:file:bg-red-700
                              focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-red-600 transition">
                @error('image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-500">
                    Format: JPG, PNG. Maks 2MB. Biarkan kosong jika tidak ingin mengubah gambar.
                </p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex space-x-4 pt-4">
                <a href="{{ route('admin.genres.index') }}"
                   class="flex-1
                          bg-gray-200 dark:bg-gray-700
                          text-gray-800 dark:text-gray-200
                          py-3 px-4 rounded-md
                          hover:bg-gray-300 dark:hover:bg-gray-600
                          transition text-center font-medium">
                    Batal
                </a>

                <button type="submit"
                        class="flex-1 bg-red-600 text-white py-3 px-4 rounded-md font-semibold hover:bg-red-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
