<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Authentication routes (loaded from auth.php)
require __DIR__.'/auth.php';

// Authenticated routes (Laravel-specific, not handled by Vue)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
// });

// Route::prefix('api')->group(function () {
//     Route::resource('products', ProductController::class);
// });

// Route::get('/',function(){
// return 'hello';
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// SPA Catch-All Route (must be last)
Route::middleware('auth')->get('/{any}', function () {
    return view('app'); // Blade view that mounts your Vue app
})->where('any', '.*');
