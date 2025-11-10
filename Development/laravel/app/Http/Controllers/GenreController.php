<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'name' => 'required|unique:genres,name',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('genres', 'public');
        }

        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath
        ]);

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
        $request->validate([
            'name' => 'required|unique:genres,name,'.$genre->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($genre->image) Storage::disk('public')->delete($genre->image);
            $genre->image = $request->file('image')->store('genres', 'public');
        }

        $genre->name = $request->name;
        $genre->description = $request->description;
        $genre->save();

        return redirect()->route('admin.genres.index')->with('success','Genre diperbarui');
    }

    public function destroy(Genre $genre)
    {
        if ($genre->image) Storage::disk('public')->delete($genre->image);
        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success','Genre dihapus');
    }
}
