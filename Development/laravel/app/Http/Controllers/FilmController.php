<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    // Menampilkan semua film
    public function index()
    {
        $films = Film::with('genre')->latest()->paginate(10);
        return view('admin.films.index', compact('films'));
    }

    // Form tambah film
    public function create()
    {
        $genres = Genre::all();
        return view('admin.films.create', compact('genres'));
    }

    // Simpan film baru
public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'sinopsis' => 'required|string',
        'tahun_rilis' => 'required|integer',
        'sutradara' => 'required|string|max:255',
        'aktor' => 'nullable|string|max:255',
        'durasi' => 'nullable|string|max:50',
        'genre_id' => 'required|exists:genres,id',
        'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $posterPath = $request->hasFile('poster')
        ? $request->file('poster')->store('posters', 'public')
        : null;

    \App\Models\Film::create([
        'poster' => $posterPath,
        'judul' => $request->judul,
        'sinopsis' => $request->sinopsis,
        'tahun_rilis' => $request->tahun_rilis,
        'sutradara' => $request->sutradara,
        'aktor' => $request->aktor,
        'durasi' => $request->durasi,
        'genre_id' => $request->genre_id,
        'user_id' => auth()->id(), // ✅ tambahkan relasi ke user yang login
    ]);

    return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan!');
}


    // Form edit film
    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('admin.films.edit', compact('film', 'genres'));
    }

    // Update film
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'tahun_rilis' => 'required|numeric',
            'sutradara' => 'required|string|max:255',
            'aktor' => 'required|string|max:255',
            'durasi' => 'required|string|max:50',
            'genre_id' => 'required|exists:genres,id',
        ]);

        if ($request->hasFile('poster')) {
            if ($film->poster) Storage::disk('public')->delete($film->poster);
            $film->poster = $request->file('poster')->store('posters', 'public');
        }

        $film->update($request->only(['judul', 'sinopsis', 'tahun_rilis', 'sutradara', 'aktor', 'durasi', 'genre_id']));

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui!');
    }

    // Hapus film
    public function destroy(Film $film)
    {
        if ($film->poster) Storage::disk('public')->delete($film->poster);
        $film->delete();
        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus!');
    }

    // Tampilkan detail film
    public function show(Film $film)
    {
        // Tambahkan ke history jika user login
        if (auth()->check()) {
            auth()->user()->watchedFilms()->syncWithoutDetaching([$film->id => ['watched_at' => now()]]);
        }

        return view('films.show', compact('film'));
    }

    // Toggle favorit
    public function toggleFavorite(Film $film)
    {
        $user = auth()->user();
        $isFavorited = $user->favoriteFilms()->where('film_id', $film->id)->exists();

        if ($isFavorited) {
            $user->favoriteFilms()->detach($film->id);
            $message = 'Film dihapus dari favorit!';
        } else {
            $user->favoriteFilms()->attach($film->id);
            $message = 'Film ditambahkan ke favorit!';
        }

        return back()->with('success', $message);
    }
}
