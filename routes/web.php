<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController;

// Root URL: Cek apakah sudah login, jika belum arahkan ke login, jika sudah ke dashboard
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Halaman Dashboard (Hanya bisa diakses jika login & email verified)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route yang membutuhkan login
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Tugas
    Route::resource('tugas', TugasController::class)->parameters([
        'tugas' => 'tugas'
    ]);
});

// Route bawaan dari Laravel Breeze/Fortify untuk login/logout/register
require __DIR__.'/auth.php';
