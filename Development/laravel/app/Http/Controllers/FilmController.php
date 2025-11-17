<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * PUBLIC INDEX
     * Halaman depan cinema (Netflix-style)
     * Mendukung search, filter genre, filter tahun.
     */
    public function publicIndex(Request $request)
    {
        $query = Film::with('genre');

        // Search judul & nama genre
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhereHas('genre', function ($genreQuery) use ($request) {
                      $genreQuery->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Filter genre
        if ($request->filled('genre')) {
            $genre = Genre::where('name', 'like', '%' . $request->genre . '%')->first();
            if ($genre) {
                $query->where('genre_id', $genre->id);
            }
        }

        // Filter tahun
        if ($request->filled('year')) {
            $query->whereYear('tahun_rilis', $request->year);
        }

        $films = $query->latest()->paginate(18);
        $genres = Genre::all();

        return view('films.index', compact('films', 'genres'));
    }

    /**
     * DETAIL FILM
     */
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    /**
     * TOGGLE FAVORITE
     * Versi yang mendukung POP-UP LOGIN + AJAX
     */
    public function toggleFavorite(Request $request, Film $film)
    {
        // Jika user belum login → kirim response AJAX
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'requires_login' => true,
                'message' => 'Anda harus login untuk menambahkan film ke favorit.'
            ], 401);
        }

        $user = auth()->user();

        $alreadyFavorited = $user->favoriteFilms()->where('film_id', $film->id)->exists();

        if ($alreadyFavorited) {
            $user->favoriteFilms()->detach($film->id);
            return response()->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Film dihapus dari favorit!'
            ]);
        }

        $user->favoriteFilms()->attach($film->id);
        return response()->json([
            'success' => true,
            'favorited' => true,
            'message' => 'Film ditambahkan ke favorit!'
        ]);
    }

    /**
     * ADMIN — INDEX
     */
    public function index()
    {
        $films = Film::with('genre')->latest()->paginate(10);
        return view('admin.films.index', compact('films'));
    }

    /**
     * ADMIN — CREATE
     */
    public function create()
    {
        $genres = Genre::all();
        return view('admin.films.create', compact('genres'));
    }

    /**
     * ADMIN — STORE
     */
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

    /**
     * ADMIN — EDIT
     */
    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('admin.films.edit', compact('film', 'genres'));
    }

    /**
     * ADMIN — UPDATE
     */
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

        // Update poster jika ada file baru
        if ($request->hasFile('poster')) {
            if ($film->poster) {
                Storage::disk('public')->delete($film->poster);
            }
            $film->poster = $request->file('poster')->store('posters', 'public');
        }

        $film->update($request->only([
            'judul', 'sinopsis', 'tahun_rilis', 'sutradara',
            'aktor', 'durasi', 'genre_id'
        ]));

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui!');
    }

    /**
     * ADMIN — DELETE
     */
    public function destroy(Film $film)
    {
        if ($film->poster) {
            Storage::disk('public')->delete($film->poster);
        }

        $film->delete();

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus!');
    }
}
