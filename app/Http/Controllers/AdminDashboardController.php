<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    // Tambah pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->boolean('is_admin', false),
        ]);

        // Log the action
        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'add_user',
            'performed_at' => now(),
            'meta' => [
                'added_user_name' => $user->name,
                'added_user_email' => $user->email,
            ],
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // (Opsional) ubah role pengguna
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->is_admin = $request->role === 'admin';
        $user->save();

        return redirect()->back()->with('success', 'Peran pengguna diperbarui!');
    }

    // (Opsional) hapus pengguna
    public function destroyUser(User $user)
    {
        // Log the action before deleting
        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_user',
            'performed_at' => now(),
            'meta' => [
                'deleted_user_name' => $user->name,
                'deleted_user_email' => $user->email,
            ],
        ]);

        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }

    // Activity logs listing for admin dashboard
    public function activityLogs()
    {
        $logs = \App\Models\AuditLog::with(['user', 'film'])
            ->orderBy('performed_at', 'desc')
            ->paginate(20);

        return view('admin.activity_logs', [
            'logs' => $logs,
        ]);
    }
}
