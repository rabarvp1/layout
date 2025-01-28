<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\catController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\income;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\suplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'first'])->name('first');

Route::get('/login', [ProductController::class, 'login'])->name('login');

Route::get('/product', [ProductController::class, 'product'])->name('product');

Route::post('/upload', [ProductController::class, 'upload']);

Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('/product/{id}/edit', [ProductController::class, 'editProduct']); // Show edit form

Route::put('/product/{id}', [ProductController::class, 'updateProduct']); // Update product

Route::get('/buy', [BuyController::class, 'buy'])->name('buy');

Route::get('/buy/view/{id}', [BuyController::class, 'view_purchase'])->name('view_purchase');

Route::post('/insert', [BuyController::class, 'insert']);

Route::get('/sell', [SellController::class, 'sell'])->name('sell');

Route::get('/sell/view/{id}', [SellController::class, 'view_invoice'])->name('view_invoice');


Route::post('/insert_sell', [SellController::class, 'insert_sell']);

Route::get('/cat', [catController::class, 'cat'])->name('cat');

Route::post('/inputCat', [catController::class, 'inputCat']);

Route::get('/income', [income::class, 'mergedData'])->name('income');

Route::get('/suplier', [suplierController::class, 'suplier'])->name('suplier');

Route::get('/buy/getData', [BuyController::class, 'getData'])->name('getData');

Route::get('/search/products', [BuyController::class, 'search'])->name('products.search');

Route::post('/inputSuplier', [suplierController::class, 'inputSuplier']);

Route::get('/customer', [CustomerController::class, 'customer'])->name('customer');

Route::post('/delete-product', [BuyController::class, 'deleteRow']);

Route::post('/inputCustomer', [CustomerController::class, 'inputCustomer']);

Route::post('/delete-sellProduct', [SellController::class, 'delete_row_sell']);

Route::get('/sell/getData_sell', [SellController::class, 'getData_sell'])->name('getData_sell');

Route::delete('/sell/{id}', [SellController::class, 'deleteInvoice']);

Route::delete('/buy/{id}', [BuyController::class, 'deletePurchase']);

Route::get('/storage',[StorageController::class,'storage'])->name('storage');

Route::get('/storage/getData_storage',[StorageController::class,'getData_storage'])->name('getData_storage');

// Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
