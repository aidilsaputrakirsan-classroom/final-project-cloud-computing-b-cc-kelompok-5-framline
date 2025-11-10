<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    // Menampilkan semua film untuk public (dengan filter genre)
    public function publicIndex(Request $request)
    {
        $query = Film::with('genre');

        // Filter berdasarkan genre jika ada
        if ($request->has('genre') && $request->genre) {
            $genre = Genre::where('name', 'like', '%' . $request->genre . '%')->first();
            if ($genre) {
                $query->where('genre_id', $genre->id);
            }
        }

        // Filter berdasarkan tahun jika ada
        if ($request->has('year') && $request->year) {
            $query->whereYear('tahun_rilis', $request->year);
        }

        $films = $query->latest()->paginate(12);
        $genres = Genre::all();

        return view('films.index', compact('films', 'genres'));
    }

    // Menampilkan detail film
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    // Toggle favorite film
    public function toggleFavorite(Film $film)
    {
        $user = auth()->user();

        if ($user->favoriteFilms()->where('film_id', $film->id)->exists()) {
            $user->favoriteFilms()->detach($film->id);
            $message = 'Film berhasil dihapus dari favorit!';
        } else {
            $user->favoriteFilms()->attach($film->id);
            $message = 'Film berhasil ditambahkan ke favorit!';
        }

        return back()->with('success', $message);
    }

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
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'tahun_rilis' => 'required|date',
            'sutradara' => 'required|string|max:255',
            'aktor' => 'required|string|max:255',
            'durasi' => 'required|string|max:50',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $posterPath = $request->hasFile('poster')
            ? $request->file('poster')->store('posters', 'public')
            : null;

        Film::create([
            'poster' => $posterPath,
            'judul' => $request->judul,
            'sinopsis' => $request->sinopsis,
            'tahun_rilis' => $request->tahun_rilis,
            'sutradara' => $request->sutradara,
            'aktor' => $request->aktor,
            'durasi' => $request->durasi,
            'genre_id' => $request->genre_id,
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
            'tahun_rilis' => 'required|date',
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
        $film->save();

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui!');
    }

    // Hapus film
    public function destroy(Film $film)
    {
        if ($film->poster) Storage::disk('public')->delete($film->poster);
        $film->delete();
        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus!');
    }
}
