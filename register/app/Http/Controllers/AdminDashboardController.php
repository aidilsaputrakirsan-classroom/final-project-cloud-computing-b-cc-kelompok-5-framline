<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\AuditLog;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $totalFilms = Film::count();
        $totalUsers = User::count();
        $recentLogs = AuditLog::latest('performed_at')->limit(10)->get();
        return view('admin.dashboard', compact('totalFilms','totalUsers','recentLogs'));
    }
}
