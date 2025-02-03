<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [ProductController::class, 'index'])->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

// // Public Routes (No Authentication)
// Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.index'); 
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// // Admin Routes (Require Authentication)
// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products.index'); 
//     Route::resource('products', ProductController::class)->except(['index', 'show']);
// });

Route::resource('products', ProductController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
