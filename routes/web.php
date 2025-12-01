<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| 🌐 Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Film public (index, detail, dan search)
Route::get('/films', [FilmController::class, 'publicIndex'])->name('films.index');
Route::get('/films/search', [FilmController::class, 'publicIndex'])->name('films.search');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');

// Jika user belum login menekan “Tambah Favorit”
Route::get('/login-required', function () {
    return response()->json([
        'status'  => 'need_login',
        'message' => 'Anda harus login terlebih dahulu untuk menambahkan film ke favorit.',
    ]);
})->name('login.required');

/*
|--------------------------------------------------------------------------
| 🔐 Authentication Routes (GET + POST)
|--------------------------------------------------------------------------
*/

// Tampilkan form login
Route::get('/login', function () {
    return view('auth.login'); // pastikan view ini ada
})->name('login');

// Proses login (form method="POST" action="{{ route('login') }}")
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('home'));
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});

// Tampilkan form register
Route::get('/register', function () {
    return view('auth.register'); // pastikan view ini ada
})->name('register');

// (Opsional) proses register sederhana – silakan sesuaikan sendiri
Route::post('/register', function (Request $request) {
    // Di sini biasanya: validasi, buat user, lalu login / redirect
    // Sementara cukup redirect balik ke login
    return redirect()->route('login');
});

// Lupa password (hanya form, tanpa logic kirim email)
Route::get('/forgot-password', function () {
    return view('auth.passwords.email'); // sesuaikan nama view
})->name('password.request');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');
})->name('logout');

// Setelah login → home/user dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| 👤 User Routes (login wajib)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Favorit & History
    Route::get('/profile/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');

    // Toggle favorit
    Route::post('/films/{film}/favorite', [FilmController::class, 'toggleFavorite'])
        ->name('films.favorite');
});

/*
|--------------------------------------------------------------------------
| 🧑‍💼 Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Kelola film
        Route::resource('/films', FilmController::class);

        // Kelola genre
        Route::resource('/genres', GenreController::class);

        // Kelola user
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
        Route::post('/users', [AdminDashboardController::class, 'store'])->name('users.store');
        Route::put('/users/{user}/role', [AdminDashboardController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');

        // Activity logs
        Route::get('/activity-logs', [AdminDashboardController::class, 'activityLogs'])->name('activity_logs');
    });
