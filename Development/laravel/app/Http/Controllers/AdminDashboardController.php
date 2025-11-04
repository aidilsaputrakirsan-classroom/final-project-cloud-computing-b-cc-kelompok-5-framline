<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung data untuk statistik
        $stats = [
            'total_films' => Film::count(),
            'total_genres' => Genre::count(),
            'total_users' => User::count(),
        ];

        // Kirim data ke view
        return view('admin.dashboard', compact('stats'));
    }

    // (Opsional) daftar pengguna
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // (Opsional) ubah role pengguna
    public function updateRole(Request $request, User $user)
    {
        $user->role = $request->input('role');
        $user->save();

        return redirect()->back()->with('success', 'Peran pengguna diperbarui!');
    }

    // (Opsional) hapus pengguna
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}
