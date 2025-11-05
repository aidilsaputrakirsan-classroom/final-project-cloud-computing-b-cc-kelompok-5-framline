<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth'); // memastikan user sudah login
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Jika admin → tampilkan dashboard admin dengan statistik
        if ($user->is_admin) {
            $stats = [
                'total_films' => Film::count(),
                'total_genres' => Genre::count(),
                'total_users' => User::count(),
            ];

            return view('admin.dashboard', compact('stats'));
        }

        // Jika user biasa → tampilkan halaman home
        return view('home');
    }
}
