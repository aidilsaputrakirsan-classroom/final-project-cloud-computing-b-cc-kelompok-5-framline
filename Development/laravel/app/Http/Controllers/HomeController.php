<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ($user->is_admin) {
            return view('admin.dashboard'); // tampilan untuk admin
        }

        return view('home'); // tampilan untuk user biasa
    }
}
