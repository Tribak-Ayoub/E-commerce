<?php

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

// SPA Catch-All Route (must be last)
Route::middleware('auth')->get('/{any}', function () {
    return view('app'); // Blade view that mounts your Vue app
})->where('any', '.*');
