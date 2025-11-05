<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;

// ==============================
// 🏠 Public routes
// ==============================
Route::get('/', [FilmController::class, 'index'])->name('landing');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/search', [FilmController::class, 'index'])->name('films.search');
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/search', [MovieController::class, 'search'])->name('movies.search');

// ==============================
// 🔐 Authentication routes
// ==============================
Auth::routes();

// Setelah login → arahkan ke HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==============================
// 👤 User profile (hanya untuk user login biasa)
// ==============================
Route::middleware(['auth'])->group(function () {
    // Halaman profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // (opsional) Form edit profil & update data
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // (opsional) Update foto profil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

// ==============================
// 🧑‍💼 Admin routes (hanya admin)
// ==============================
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Films (khusus admin)
        Route::get('/films', [FilmController::class, 'index'])->name('films.index');
        Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
        Route::post('/films', [FilmController::class, 'store'])->name('films.store');
        Route::get('/films/{film}/edit', [FilmController::class, 'edit'])->name('films.edit');
        Route::put('/films/{film}', [FilmController::class, 'update'])->name('films.update');
        Route::delete('/films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');

        // CRUD Genre (khusus admin)
        Route::resource('genres', GenreController::class)->only(['index', 'store', 'destroy']);
    });
