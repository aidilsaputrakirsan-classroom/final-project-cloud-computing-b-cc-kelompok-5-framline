@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-black via-[#141414] to-[#1a1a1a] text-white px-8 py-16 relative overflow-hidden">

  {{-- Background Cinematic Overlay --}}
  <div class="absolute inset-0 bg-[url('/images/netflix-bg.jpg')] bg-cover bg-center opacity-25"></div>
  <div class="absolute inset-0 bg-gradient-to-b from-black/95 via-black/80 to-[#141414]"></div>

  <div class="relative z-10 max-w-3xl mx-auto">
    <h1 class="text-5xl font-extrabold mb-12 text-center text-red-600 tracking-wide drop-shadow-[0_0_20px_#dc2626]">
      🎬 Tambah Film Baru
    </h1>

    <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-6 bg-black/70 p-10 rounded-3xl shadow-[0_0_35px_rgba(220,38,38,0.4)] backdrop-blur-xl border border-red-800/50 transition-all duration-500 hover:shadow-[0_0_50px_rgba(220,38,38,0.6)]">
      @csrf

      {{-- Poster --}}
      <div>
        <label class="block text-gray-200 font-semibold mb-2 transition-colors duration-300">Poster Film</label>
        <input type="file" name="poster"
               class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300">
      </div>

      {{-- Judul --}}
      <div>
        <label class="block text-gray-200 font-semibold mb-2">Judul Film</label>
        <input type="text" name="judul"
               class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
      </div>

      {{-- Sinopsis --}}
      <div>
        <label class="block text-gray-200 font-semibold mb-2">Sinopsis</label>
        <textarea name="sinopsis" rows="4"
                  class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required></textarea>
      </div>

      {{-- Tahun & Durasi --}}
      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-200 font-semibold mb-2">Tahun Rilis</label>
          <input type="date" name="tahun_rilis"
                 class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
        </div>
        <div>
          <label class="block text-gray-200 font-semibold mb-2">Durasi (menit)</label>
          <input type="text" name="durasi"
                 class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
        </div>
      </div>

      {{-- Sutradara --}}
      <div>
        <label class="block text-gray-200 font-semibold mb-2">Sutradara</label>
        <input type="text" name="sutradara"
               class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
      </div>

      {{-- Aktor --}}
      <div>
        <label class="block text-gray-200 font-semibold mb-2">Aktor</label>
        <input type="text" name="aktor"
               class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
      </div>

      {{-- Genre --}}
      <div>
        <label class="block text-gray-200 font-semibold mb-2">Genre</label>
        <div class="flex items-center space-x-3">
          <select name="genre_id" id="genre-select"
                  class="block w-full border border-red-800/60 rounded-lg bg-[#0d0d0d] text-gray-200 p-3 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
            <option value="">-- Pilih Genre --</option>
            @foreach ($genres as $genre)
              <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
          </select>
          <button type="button" onclick="openGenreModal()"
                  class="bg-red-700 hover:bg-red-800 px-4 py-3 rounded-lg font-semibold text-white shadow-[0_0_20px_rgba(220,38,38,0.6)] hover:shadow-[0_0_35px_rgba(220,38,38,0.8)] transition-all duration-300">
            + Tambah Genre
          </button>
        </div>
      </div>

      {{-- Tombol Simpan --}}
      <div class="pt-10 text-center">
        <button class="bg-red-700 hover:bg-red-800 px-10 py-3 rounded-xl font-bold text-white shadow-[0_0_30px_rgba(220,38,38,0.6)] hover:shadow-[0_0_50px_rgba(220,38,38,0.9)] transition-all duration-300 transform hover:scale-105">
          💾 Simpan Film
        </button>
      </div>
    </form>
  </div>

  {{-- Modal Tambah Genre --}}
  <div id="genre-modal" class="fixed inset-0 bg-black/90 backdrop-blur-sm flex justify-center items-center hidden z-50 transition-all duration-500">
    <div class="bg-[#0d0d0d] p-8 rounded-2xl border border-red-700/60 w-96 shadow-[0_0_35px_rgba(220,38,38,0.5)] transition-all duration-500 hover:shadow-[0_0_55px_rgba(220,38,38,0.7)]">
      <h3 class="text-2xl font-semibold text-red-500 mb-4 text-center">Tambah Genre Baru</h3>
      <form id="genre-form" class="space-y-5">
        @csrf
        <div>
          <label class="block text-gray-200 mb-2">Nama Genre</label>
          <input type="text" id="genre-name"
                 class="w-full p-3 bg-[#101010] border border-red-800/60 rounded-lg text-gray-200 focus:bg-black focus:text-white focus:ring-2 focus:ring-red-600 focus:border-red-700 transition-all duration-300" required>
        </div>
        <div class="flex justify-end space-x-4">
          <button type="button" onclick="closeGenreModal()"
                  class="px-5 py-2 bg-gray-700 hover:bg-gray-800 rounded-lg text-white font-medium transition-all duration-300">Batal</button>
          <button type="submit"
                  class="px-5 py-2 bg-red-700 hover:bg-red-800 rounded-lg font-semibold text-white shadow-[0_0_20px_rgba(220,38,38,0.5)] hover:shadow-[0_0_35px_rgba(220,38,38,0.8)] transition-all duration-300">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function openGenreModal() {
  document.getElementById('genre-modal').classList.remove('hidden');
  document.getElementById('genre-name').focus();
}
function closeGenreModal() {
  document.getElementById('genre-modal').classList.add('hidden');
  document.getElementById('genre-name').value = '';
}

// Submit genre form via AJAX
document.getElementById('genre-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const genreName = document.getElementById('genre-name').value;

  fetch('{{ route("admin.genres.store") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ name: genreName })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const select = document.getElementById('genre-select');
      const option = document.createElement('option');
      option.value = data.genre.id;
      option.textContent = data.genre.name;
      select.appendChild(option);
      select.value = data.genre.id;
      closeGenreModal();
      alert('✅ Genre berhasil ditambahkan!');
    } else {
      alert('❌ Gagal menambahkan genre: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat menambahkan genre');
  });
});
</script>
@endsection
