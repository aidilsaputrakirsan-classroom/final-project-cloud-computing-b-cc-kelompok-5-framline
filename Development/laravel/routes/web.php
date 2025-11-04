<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| 🌐 Public Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman utama (Landing Page)
Route::get('/', function () {
    return view('index'); // resources/views/index.blade.php
})->name('landing');

// 🎬 Film publik (tanpa login)
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/search', [FilmController::class, 'index'])->name('films.search');

/*
|--------------------------------------------------------------------------
| 🔐 Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes();

// Setelah login → dashboard user biasa
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| 👤 User Routes (Hanya untuk user login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profil pengguna
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/photo', [ProfileController::class, 'updatePhoto'])->name('photo.update');

        // Favorit & Riwayat tontonan
        Route::get('/favorites', [ProfileController::class, 'favorites'])->name('favorites');
        Route::get('/history', [ProfileController::class, 'history'])->name('history');
    });

    // Toggle favorit film
    Route::post('/films/{film}/favorite', [FilmController::class, 'toggleFavorite'])->name('films.favorite');
});

/*
|--------------------------------------------------------------------------
| 🧑‍💼 Admin Routes (Hanya untuk admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Kelola film (CRUD)
        Route::resource('/films', FilmController::class);

        // Kelola genre (CRUD terbatas)
        Route::resource('/genres', GenreController::class)->only(['index', 'store', 'destroy']);

        // Kelola pengguna
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'users'])->name('index');
            Route::post('/', [AdminDashboardController::class, 'store'])->name('store');
            Route::put('/{user}/role', [AdminDashboardController::class, 'updateRole'])->name('updateRole');
            Route::delete('/{user}', [AdminDashboardController::class, 'destroyUser'])->name('destroy');
        });
    });
