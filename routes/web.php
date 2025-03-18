<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\PuskesmasController;

// Halaman utama menampilkan peta
Route::get('/', function () {
    return view('map');
});

// Dashboard hanya bisa diakses jika sudah login & terverifikasi
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware Auth untuk profile dan admin
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Route::get('/register', function () {
//     return redirect('/login');
// })->name('register');

// Route::post('/register', function () {
//     return redirect('/login');
// });



// Dataset Routes
Route::middleware('auth')->group(function () {
    Route::get('/dataset', [DatasetController::class, 'index'])->name('dataset.index');
    Route::get('/dataset/create', [DatasetController::class, 'create'])->name('dataset.create');
    Route::post('/dataset/store', [DatasetController::class, 'store'])->name('dataset.store');
    Route::get('/dataset/{id}/edit', [DatasetController::class, 'edit'])->name('dataset.edit');
    Route::put('/dataset/{id}', [DatasetController::class, 'update'])->name('dataset.update');
    Route::delete('/dataset/{id}', [DatasetController::class, 'destroy'])->name('dataset.destroy');
});

// API Puskesmas
Route::get('/api/puskesmas/{namaPuskesmas}', [PuskesmasController::class, 'getPuskesmasData']);

// Menangkap semua route yang tidak ada dan mengarahkannya ke halaman 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Load authentication routes
require __DIR__ . '/auth.php';
