<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AdminDashboardController;

// Home & public
Route::get('/', [FilmController::class, 'index'])->name('home');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/search', [FilmController::class, 'index'])->name('films.search');

// Auth scaffolding (if installed)
Auth::routes();

// Admin group
Route::prefix('admin')->middleware(['auth','is_admin'])->name('admin.')->group(function(){
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // films CRUD for admin
    Route::get('films', [FilmController::class,'index'])->name('films.index'); // admin list
    Route::get('films/create', [FilmController::class,'create'])->name('films.create');
    Route::post('films', [FilmController::class,'store'])->name('films.store');
    Route::get('films/{film}/edit', [FilmController::class,'edit'])->name('films.edit');
    Route::put('films/{film}', [FilmController::class,'update'])->name('films.update');
    Route::delete('films/{film}', [FilmController::class,'destroy'])->name('films.destroy');

    // genres
    Route::resource('genres', GenreController::class)->only(['index','store','destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
