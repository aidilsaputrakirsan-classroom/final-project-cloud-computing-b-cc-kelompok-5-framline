@extends('layouts.app')

@section('content')
<div class="min-h-screen
    bg-gradient-to-b from-white via-gray-100 to-gray-200
    text-gray-900 px-8 py-16 relative overflow-hidden
    dark:bg-gradient-to-b dark:from-black dark:via-[#141414] dark:to-[#1a1a1a] dark:text-white">

  {{-- Background Cinematic Overlay --}}
  <div class="absolute inset-0 bg-[url('/images/netflix-bg.jpg')] bg-cover bg-center
      opacity-10 dark:opacity-25"></div>

  <div class="absolute inset-0
      bg-gradient-to-b from-white/80 via-white/60 to-gray-200
      dark:bg-gradient-to-b dark:from-black/95 dark:via-black/80 dark:to-[#141414]"></div>

  <div class="relative z-10 max-w-3xl mx-auto">
    <div class="mb-6">
      <a href="{{ route('admin.films.index') }}"
         class="inline-flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2 text-sm font-semibold
                text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2
                focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
        ← Kembali ke Kelola Film
      </a>
    </div>

    <h1 class="text-5xl font-extrabold mb-12 text-center tracking-wide
        text-red-600 dark:text-red-600
        drop-shadow-[0_0_20px_#dc2626]">
      🎬 Tambah Film Baru
    </h1>

    <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-6
          bg-white/80 dark:bg-black/70
          p-10 rounded-3xl
          border border-red-500/30 dark:border-red-800/50
          shadow-[0_0_25px_rgba(220,38,38,0.15)]
          hover:shadow-[0_0_40px_rgba(220,38,38,0.25)]
          backdrop-blur-xl transition-all duration-500">
      @csrf

      {{-- Poster --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Poster Film</label>
        <input type="file" name="poster"
               class="block w-full border @error('poster') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
               bg-white dark:bg-[#0d0d0d]
               text-gray-900 dark:text-gray-200 p-3">
        @error('poster')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Judul --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Judul Film</label>
        <input type="text" name="judul"
               class="block w-full border @error('judul') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
               bg-white dark:bg-[#0d0d0d]
               text-gray-900 dark:text-gray-200 p-3" required>
        @error('judul')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Trailer URL --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Link Trailer (YouTube)</label>
        <input type="text" name="trailer_url" placeholder="https://youtu.be/xxxxx atau ID video"
               class="block w-full border @error('trailer_url') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
               bg-white dark:bg-[#0d0d0d]
               text-gray-900 dark:text-gray-200 p-3">
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Masukkan URL YouTube atau ID video.</p>
        @error('trailer_url')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Sinopsis --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Sinopsis</label>
        <textarea name="sinopsis" rows="4"
                  class="block w-full border @error('sinopsis') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
                  bg-white dark:bg-[#0d0d0d]
                  text-gray-900 dark:text-gray-200 p-3" required></textarea>
        @error('sinopsis')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tahun & Durasi --}}
      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Tahun Rilis</label>
          <input type="date" name="tahun_rilis"
                 class="block w-full border @error('tahun_rilis') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
                 bg-white dark:bg-[#0d0d0d]
                 text-gray-900 dark:text-gray-200 p-3" required>
          @error('tahun_rilis')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Durasi (menit)</label>
          <input type="number" name="durasi"
                 class="block w-full border @error('durasi') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
                 bg-white dark:bg-[#0d0d0d]
                 text-gray-900 dark:text-gray-200 p-3" required>
          @error('durasi')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Sutradara --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Sutradara</label>
        <input type="text" name="sutradara"
               class="block w-full border @error('sutradara') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
               bg-white dark:bg-[#0d0d0d]
               text-gray-900 dark:text-gray-200 p-3" required>
        @error('sutradara')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Aktor --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Aktor</label>
        <input type="text" name="aktor"
               class="block w-full border @error('aktor') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
               bg-white dark:bg-[#0d0d0d]
               text-gray-900 dark:text-gray-200 p-3" required>
        @error('aktor')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Genre --}}
      <div>
        <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Genre</label>
        <div class="flex items-center space-x-3">
          <select name="genre_id" id="genre-select"
                  class="block w-full border @error('genre_id') border-red-600 @enderror border-red-500/40 dark:border-red-800/60 rounded-lg
                  bg-white dark:bg-[#0d0d0d]
                  text-gray-900 dark:text-gray-200 p-3" required>
            <option value="">-- Pilih Genre --</option>
            @foreach ($genres as $genre)
              <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
          </select>

          <button type="button" onclick="openGenreModal()"
                  class="bg-red-600 hover:bg-red-700 px-4 py-3 rounded-lg font-semibold text-white
                  shadow-[0_0_15px_rgba(220,38,38,0.5)]">
            + Genre
          </button>
        </div>
        @error('genre_id')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol Simpan --}}
      <div class="pt-10 text-center">
        <button class="bg-red-600 hover:bg-red-700 px-10 py-3 rounded-xl font-bold text-white
                shadow-[0_0_25px_rgba(220,38,38,0.5)] hover:scale-105 transition-all duration-300">
          💾 Simpan Film
        </button>
      </div>
    </form>
  </div>

  {{-- MODAL --}}
  <div id="genre-modal"
       class="fixed inset-0 bg-white/80 dark:bg-black/90 backdrop-blur-sm flex justify-center items-center hidden z-50">
    <div class="bg-white dark:bg-[#0d0d0d] p-8 rounded-2xl
        border border-red-500/40 dark:border-red-700/60 w-96">
      <h3 class="text-2xl font-semibold text-red-600 mb-4 text-center">Tambah Genre Baru</h3>

      <form id="genre-form" class="space-y-5">
        @csrf
        <div>
          <label class="block text-gray-700 dark:text-gray-200 mb-2">Nama Genre</label>
          <input type="text" id="genre-name"
                 class="w-full p-3 bg-gray-100 dark:bg-[#101010]
                 border border-red-500/40 dark:border-red-800/60
                 rounded-lg text-gray-900 dark:text-gray-200" required>
        </div>

        <div class="flex justify-end space-x-4">
          <button type="button" onclick="closeGenreModal()"
                  class="px-5 py-2 bg-gray-300 dark:bg-gray-700
                  hover:bg-gray-400 dark:hover:bg-gray-800
                  rounded-lg text-gray-900 dark:text-white">
            Batal
          </button>
          <button type="submit"
                  class="px-5 py-2 bg-red-600 hover:bg-red-700 rounded-lg font-semibold text-white">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function openGenreModal() {
  document.getElementById('genre-modal').classList.remove('hidden');
}
function closeGenreModal() {
  document.getElementById('genre-modal').classList.add('hidden');
  document.getElementById('genre-name').value = '';
}

document.getElementById('genre-form').addEventListener('submit', function (e) {
  e.preventDefault();

  fetch('{{ route('admin.genres.store') }}', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ name: document.getElementById('genre-name').value })
  })
  .then(res => res.json())
  .then(data => {
      if (data.success) {
          let select = document.getElementById('genre-select');
          let option = document.createElement('option');
          option.value = data.genre.id;
          option.textContent = data.genre.name;
          select.appendChild(option);
          select.value = data.genre.id;
          closeGenreModal();
      } else {
          alert('Gagal menambahkan genre');
      }
  });
});
</script>

@endsection
