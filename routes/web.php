<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\catController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use Illuminate\Support\Facades\Route;

Route::get('/product', [ProductController::class, 'product']);

Route::post('/upload', [ProductController::class, 'upload']);

Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);

// Route::get('/product/{id}/edit', [ProductController::class, 'editProduct']); // Show edit form

Route::put('/product/{id}', [ProductController::class, 'updateProduct']);  // Update product



Route::get('/buy', [BuyController::class, 'buy']);

Route::get('/sell', [SellController::class, 'sell']);

Route::get('/cat', [catController::class, 'cat']);

Route::post('/inputCat', [catController::class, 'inputCat']);

// Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

