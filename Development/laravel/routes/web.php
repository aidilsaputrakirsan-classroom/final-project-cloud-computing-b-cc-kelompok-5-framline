<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| 🌐 Public Routes
|--------------------------------------------------------------------------
*/

// 🏠 Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// 🎬 Film routes (umum, bisa dilihat tanpa login)
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/search', [FilmController::class, 'index'])->name('films.search');

/*
|--------------------------------------------------------------------------
| 🔐 Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

// Setelah login → arahkan ke dashboard user biasa
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| 👤 User Routes (hanya user login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

    // Favorit & Riwayat tontonan
    Route::get('/profile/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');
});

/*
|--------------------------------------------------------------------------
| 🧑‍💼 Admin Routes (hanya untuk admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard utama admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Kelola film
        Route::resource('/films', FilmController::class);

        // Kelola genre
<<<<<<< HEAD
        Route::resource('/genres', GenreController::class)->only(['index', 'store', 'destroy']);
=======
        Route::resource('/genres', GenreController::class);
>>>>>>> d168e3780e5f1f3c9b51910f8c992ac94aaa8773

        // Kelola user
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
        Route::put('/users/{user}/role', [AdminDashboardController::class, 'updateRole'])->name('users.role');
        Route::delete('/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');
    });
