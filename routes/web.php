<?php

use App\Http\Controllers\product;
use App\Http\Controllers\buy;
use App\Http\Controllers\sell;

use Illuminate\Support\Facades\Route;

Route::get('/product', [product::class,'product']);

Route::get('/buy', [buy::class,'buy']);

Route::get('/sell', [sell::class,'sell']);
