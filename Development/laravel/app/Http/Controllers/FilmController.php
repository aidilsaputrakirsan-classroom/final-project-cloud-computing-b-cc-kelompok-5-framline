<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AuditLog;

class FilmController extends Controller
{
    public function publicIndex(Request $request)
    {
        $query = Film::with('genre');

        if ($request->search) {
            $query->where('judul', 'like', "%{$request->search}%")
                  ->orWhereHas('genre', function ($q) use ($request) {
                      $q->where('name', 'like', "%{$request->search}%");
                  });
        }

        if ($request->genre) {
            $genre = Genre::where('name', 'like', "%{$request->genre}%")->first();
            if ($genre) {
                $query->where('genre_id', $genre->id);
            }
        }

        if ($request->year) {
            $query->whereYear('tahun_rilis', $request->year);
        }

        return view('films.index', [
            'films' => $query->latest()->paginate(18),
            'genres' => Genre::all(),
        ]);
    }

    public function show(Film $film)
    {
        if (auth()->check()) {
            auth()->user()
                ->watchedFilms()
                ->syncWithoutDetaching([
                    $film->id => ['watched_at' => now()]
                ]);

            // log open film detail
            AuditLog::create([
                'user_id' => auth()->user()->id,
                'film_id' => $film->id,
                'action' => 'open_film_detail',
                'performed_at' => now(),
                'meta' => null,
            ]);
        }

        return view('films.show', compact('film'));
    }

    public function toggleFavorite(Request $request, Film $film)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'requires_login' => true,
                'message' => 'Anda harus login untuk menambahkan ke favorit.'
            ], 401);
        }

        $user = auth()->user();

        if ($user->favoriteFilms()->where('film_id', $film->id)->exists()) {
            $user->favoriteFilms()->detach($film->id);

            // log remove favorite
            AuditLog::create([
                'user_id' => $user->id,
                'film_id' => $film->id,
                'action' => 'remove_favorite',
                'performed_at' => now(),
                'meta' => null,
            ]);

            return response()->json([
                'success' => true,
                'favorited' => false,
                'message' => 'Film dihapus dari favorit.'
            ]);
        }

        $user->favoriteFilms()->attach($film->id);

        // log add favorite
        AuditLog::create([
            'user_id' => $user->id,
            'film_id' => $film->id,
            'action' => 'add_favorite',
            'performed_at' => now(),
            'meta' => null,
        ]);

        return response()->json([
            'success' => true,
            'favorited' => true,
            'message' => 'Film ditambahkan ke favorit!'
        ]);
    }

    public function index()
    {
        return view('admin.films.index', [
            'films' => Film::with('genre')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.films.create', [
            'genres' => Genre::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|max:255',
            'sinopsis' => 'required',
            'tahun_rilis' => 'required|date',
            'sutradara' => 'required|max:255',
            'aktor' => 'required|string',
            'durasi' => 'required|string|max:50',
            'genre_id' => 'required|exists:genres,id',
            'trailer_url' => 'nullable|url',
        ]);

        $poster = $request->hasFile('poster')
            ? $request->file('poster')->store('posters', 'public')
            : null;

        Film::create([
            'poster' => $poster,
            'judul' => $request->judul,
            'sinopsis' => $request->sinopsis,
            'tahun_rilis' => $request->tahun_rilis,
            'sutradara' => $request->sutradara,
            'aktor' => $request->aktor,
            'durasi' => $request->durasi,
            'genre_id' => $request->genre_id,
            'trailer_url' => $request->trailer_url,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil ditambahkan!');
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', [
            'film' => $film,
            'genres' => Genre::all(),
        ]);
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul' => 'required|max:255',
            'sinopsis' => 'required',
            'tahun_rilis' => 'required|date',
            'sutradara' => 'required|max:255',
            'aktor' => 'required|string',
            'durasi' => 'required|string|max:50',
            'genre_id' => 'required|exists:genres,id',
            'trailer_url' => 'nullable|url',
        ]);

        if ($request->hasFile('poster')) {
            if ($film->poster) {
                Storage::disk('public')->delete($film->poster);
            }

            $film->poster = $request->file('poster')->store('posters', 'public');
        }

        $film->update([
            'judul' => $request->judul,
            'sinopsis' => $request->sinopsis,
            'tahun_rilis' => $request->tahun_rilis,
            'sutradara' => $request->sutradara,
            'aktor' => $request->aktor,
            'durasi' => $request->durasi,
            'genre_id' => $request->genre_id,
            'trailer_url' => $request->trailer_url,
        ]);

        return redirect()->route('admin.films.index')
            ->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy(Film $film)
    {
        if ($film->poster) {
            Storage::disk('public')->delete($film->poster);
        }

        $film->delete();

        return redirect()->route('admin.films.index')

            ->with('success', 'Film berhasil dihapus!');
    }
}
