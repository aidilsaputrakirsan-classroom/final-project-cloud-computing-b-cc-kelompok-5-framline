<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        // tampilkan halaman home tanpa hasil search
        return view('home', ['movies' => []]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('movies.index');
        }

        $apiKey = env('OMDB_API_KEY');
        $response = Http::get('https://www.omdbapi.com/', [
            'apikey' => $apiKey,
            's' => $query
        ]);

        $data = $response->json();
        $movies = $data['Search'] ?? [];

        // kirim hasil ke halaman home juga
        return view('home', [
            'movies' => $movies,
            'query' => $query
        ]);
    }
}
