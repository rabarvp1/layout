<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\SellController;

use Illuminate\Support\Facades\Route;

Route::get('/product', [ProductController::class,'product']);

Route::post('/upload', [ProductController::class,'upload']);

Route::get('/buy', [BuyController::class,'buy']);

Route::get('/sell', [SellController::class,'sell']);
