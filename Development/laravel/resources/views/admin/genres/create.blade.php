@extends('layouts.app')

@section('title', 'Tambah Genre - Cinema XXI')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center justify-start pt-24 pb-16">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h1 class="text-3xl font-bold text-teal-700 mb-6 text-center">➕ Tambah Genre Baru</h1>

        <form action="{{ route('admin.genres.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Genre</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                       placeholder="Masukkan nama genre"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Genre</label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                          placeholder="Masukkan deskripsi genre (opsional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Genre</label>
                <input type="file"
                       id="image"
                       name="image"
                       accept="image/*"
                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Maksimal 2MB.</p>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('admin.genres.index') }}"
                   class="flex-1 bg-gray-200 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-300 transition text-center">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 bg-teal-600 text-darkpy-3 px-4 rounded-lg hover:bg-teal-700 transition">
                    Simpan Genre
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
