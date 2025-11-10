<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required|unique:genres,name']);

        $genre = Genre::create($request->only('name'));

        // Jika request AJAX, return JSON response
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'genre' => $genre,
                'message' => 'Genre berhasil ditambahkan'
            ]);
        }

        return redirect()->route('admin.genres.index')->with('success','Genre ditambahkan');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate(['name'=>'required|unique:genres,name,'.$genre->id]);
        $genre->update($request->only('name'));
        return redirect()->route('admin.genres.index')->with('success','Genre diperbarui');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success','Genre dihapus');
    }
}
