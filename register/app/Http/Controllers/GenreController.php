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

    public function store(Request $r)
    {
        $r->validate(['name'=>'required|unique:genres,name']);
        Genre::create($r->only('name'));
        return back()->with('success','Genre ditambahkan');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return back()->with('success','Genre dihapus');
    }
}
