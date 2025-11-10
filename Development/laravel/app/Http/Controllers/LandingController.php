<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Genre;


class LandingController extends Controller
{
    // Menampilkan halaman utama tanpa login
    public function index()
    {
        // Ambil semua film dari database (hanya kolom penting)
        $films = Film::select('id', 'judul', 'poster')->latest()->get();

        // Ambil semua genre untuk browse
        $genres = Genre::all();

        // Kirim ke view index.blade.php
        return view('index', compact('films', 'genres'));
    }
}
