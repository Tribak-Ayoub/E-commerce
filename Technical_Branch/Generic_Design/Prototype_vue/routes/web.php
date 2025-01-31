<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('api')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
});

Route::get('/{any}', function () {
    return view('app'); // Loads Vue
})->where('any', '.*');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
