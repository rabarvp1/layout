<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\catController;
use App\Http\Controllers\income;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\suplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'first'])->name('first');

Route::get('/product', [ProductController::class, 'product'])->name('product');

Route::post('/upload', [ProductController::class, 'upload']);

Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('/product/{id}/edit', [ProductController::class, 'editProduct']); // Show edit form

Route::put('/product/{id}', [ProductController::class, 'updateProduct']);  // Update product



Route::get('/buy', [BuyController::class, 'buy'])->name('buy');



Route::post('/insert', [BuyController::class, 'insert']);

Route::get('/sell', [SellController::class, 'sell'])->name('sell');

Route::post('/insert_sell', [SellController::class, 'insert_sell']);

Route::get('/cat', [catController::class, 'cat'])->name('cat');

Route::post('/inputCat', [catController::class, 'inputCat']);


Route::get('/income', [income::class, 'mergedData'])->name('income');

Route::get('/suplier', [suplierController::class, 'suplier'])->name('suplier');

Route::get('/buy/getData', [BuyController::class, 'getData'])->name('getData');

Route::post('/inputSuplier', [suplierController::class, 'inputSuplier']);



// Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

