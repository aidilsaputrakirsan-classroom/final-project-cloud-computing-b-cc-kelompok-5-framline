<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show','search']);
    }

    public function index(Request $req)
    {
        // $query = Film::query()->with('genres');

        // if ($req->filled('q')) {
        //     $q = $req->q;
        //     $query->where('title','like', "%{$q}%")
        //           ->orWhere('director','like', "%{$q}%");
        // }

        // if ($req->filled('genre')) {
        //     $genre = $req->genre;
        //     $query->whereHas('genres', fn($q) => $q->where('name', $genre));
        // }

        // if ($req->filled('sort')) {
        //     if ($req->sort === 'newest') $query->orderBy('release_date','desc');
        //     if ($req->sort === 'duration_asc') $query->orderBy('duration','asc');
        // }

        // $films = $query->paginate(12);
        // $genres = Genre::all();
        // $query = Film::query()->with('genres');

        // if ($req->filled('q')) {
        //     $q = $req->q;
        //     $query->where('title','like', "%{$q}%")
        //           ->orWhere('director','like', "%{$q}%");
        // }

        // if ($req->filled('genre')) {
        //     $genre = $req->genre;
        //     $query->whereHas('genres', fn($q) => $q->where('name', $genre));
        // }

        // if ($req->filled('sort')) {
        //     if ($req->sort === 'newest') $query->orderBy('release_date','desc');
        //     if ($req->sort === 'duration_asc') $query->orderBy('duration','asc');
        // }

        // $films = $query->paginate(12);
        // $genres = Genre::all();
        // return view('films.index', compact('films','genres'));
        return view('dashboard');
    }

    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    // Admin CRUD
    public function create()
    {
        $this->authorizeAdmin();
        $genres = Genre::all();
        return view('admin.films.create', compact('genres'));
    }

    public function store(Request $req)
    {
        $this->authorizeAdmin();
        $data = $req->validate([
            'title'=>'required|string',
            'description'=>'nullable|string',
            'director'=>'nullable|string',
            'release_date'=>'nullable|date',
            'duration'=>'nullable|integer',
            'poster_url'=>'nullable|url',
            'trailer_url'=>'nullable|url',
            'genres'=>'nullable|array'
        ]);

        $film = Film::create($data);
        if (!empty($data['genres'])) $film->genres()->sync($data['genres']);

        AuditLog::create(['user_id'=>auth()->id(),'film_id'=>$film->id,'action'=>'tambah','meta'=>json_encode(['title'=>$film->title])]);

        return redirect()->route('admin.films.index')->with('success','Film berhasil ditambah');
    }

    public function edit(Film $film)
    {
        $this->authorizeAdmin();
        $genres = Genre::all();
        return view('admin.films.edit', compact('film','genres'));
    }

    public function update(Request $req, Film $film)
    {
        $this->authorizeAdmin();
        $data = $req->validate([
            'title'=>'required|string',
            'description'=>'nullable|string',
            'director'=>'nullable|string',
            'release_date'=>'nullable|date',
            'duration'=>'nullable|integer',
            'poster_url'=>'nullable|url',
            'trailer_url'=>'nullable|url',
            'genres'=>'nullable|array'
        ]);

        $film->update($data);
        if (isset($data['genres'])) $film->genres()->sync($data['genres']);

        AuditLog::create(['user_id'=>auth()->id(),'film_id'=>$film->id,'action'=>'edit','meta'=>json_encode(['title'=>$film->title])]);
        return redirect()->route('admin.films.index')->with('success','Film berhasil diupdate');
    }

    public function destroy(Film $film)
    {
        $this->authorizeAdmin();
        AuditLog::create(['user_id'=>auth()->id(),'film_id'=>$film->id,'action'=>'hapus','meta'=>json_encode(['title'=>$film->title])]);
        $film->delete();
        return back()->with('success','Film dihapus');
    }

    protected function authorizeAdmin()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) abort(403);
    }
}
