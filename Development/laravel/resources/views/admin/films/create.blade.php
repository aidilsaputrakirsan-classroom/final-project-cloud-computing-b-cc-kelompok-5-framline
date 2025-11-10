@extends('layouts.app')

@section('content')
<div class="p-8">
  <h1 class="text-2xl font-bold mb-6">➕ Tambah Film Baru</h1>

  <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
      <label>Poster Film</label>
      <input type="file" name="poster" class="block w-full border rounded p-2">
    </div>

    <div>
      <label>Judul Film</label>
      <input type="text" name="judul" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Sinopsis</label>
      <textarea name="sinopsis" rows="4" class="block w-full border rounded p-2" required></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label>Tahun Rilis</label>
        <input type="date" name="tahun_rilis" class="block w-full border rounded p-2" required>
      </div>
      <div>
        <label>Durasi (menit)</label>
        <input type="text" name="durasi" class="block w-full border rounded p-2" required>
      </div>
    </div>

    <div>
      <label>Sutradara</label>
      <input type="text" name="sutradara" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label>Aktor</label>
      <input type="text" name="aktor" class="block w-full border rounded p-2" required>
    </div>

    <div>
      <label class="block mb-1 text-gray-800">Genre</label>
      <div class="flex items-center space-x-2">
        <select name="genre_id"
                id="genre-select"
                class="block w-full border rounded p-2 text-black bg-white"
                required>
          <option value="">-- Pilih Genre --</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
          @endforeach
        </select>
        <button type="button"
                onclick="openGenreModal()"
                class="bg-teal-600 text-white px-3 py-2 rounded hover:bg-teal-700 text-sm whitespace-nowrap">
           + Tambah Genre
        </button>
      </div>
    </div>


    <button class="bg-teal-600 text-dark px-4 py-2 rounded hover:bg-teal-700">Simpan</button>
  </form>

  <!-- Modal Tambah Genre -->
  <div id="genre-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
      <div class="mt-3">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Genre Baru</h3>
        <form id="genre-form" class="space-y-4">
          @csrf
          <div>
            <label class="block text-sm font-medium text-gray-700">Nama Genre</label>
            <input type="text"
                   id="genre-name"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                   required>
          </div>
          <div class="flex justify-end space-x-2">
            <button type="button"
                    onclick="closeGenreModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
              Batal
            </button>
            <button type="submit"
                    class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
              Simpan Genre
            </button>
          </div>
        </form>
      </div>
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
    body: JSON.stringify({
      name: genreName
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Add new genre to select dropdown
      const select = document.getElementById('genre-select');
      const option = document.createElement('option');
      option.value = data.genre.id;
      option.textContent = data.genre.name;
      select.appendChild(option);

      // Select the new genre
      select.value = data.genre.id;

      // Close modal
      closeGenreModal();

      // Show success message
      alert('Genre berhasil ditambahkan!');
    } else {
      alert('Gagal menambahkan genre: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat menambahkan genre');
  });
});
</script>
@endsection
