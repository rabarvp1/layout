<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\catController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\income;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\suplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'first'])->name('first');

Route::get('/product', [ProductController::class, 'product'])->name('product');

Route::get('/product', [ProductController::class, 'index'])->name('products.index');

Route::post('/upload', [ProductController::class, 'upload']);

Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('/product/{id}/edit', [ProductController::class, 'editProduct']); // Show edit form

Route::put('/product/{id}', [ProductController::class, 'updateProduct']); // Update product

Route::get('/buy', [BuyController::class, 'buy'])->name('buy');

Route::get('/buy/data', [BuyController::class, 'getPurchases'])->name('buy.data');

Route::get('/buy/view/{id}', [BuyController::class, 'view_purchase'])->name('view_purchase');

Route::get('/buy/{id}/edit', [BuyController::class, 'edit_purchase'])->name('edit_purchase');

Route::put('/buy/{id}', [BuyController::class, 'purchase_update']); // Update purchase

Route::post('/insert', [BuyController::class, 'insert']);

Route::get('/sell', [SellController::class, 'sell'])->name('sell');

Route::get('/sell/view/{id}', [SellController::class, 'view_invoice'])->name('view_invoice');

Route::get('/sell/{id}/edit', [SellController::class, 'edit_invoice'])->name('edit_invoice');

Route::put('/sell/{id}', [SellController::class, 'update_invoice']);

Route::get('/customer/search', [SellController::class, 'search_customer'])->name('search_customer');

Route::post('/insert_sell', [SellController::class, 'insert_sell']);

Route::get('/cat', [catController::class, 'cat'])->name('cat');

Route::get('/cat/{id}/edit', [catController::class, 'cat_edit'])->name('cat_edit');

Route::put('/cat/{id}', [catController::class, 'cat_update'])->name('cat_update');

Route::delete('/cat/{id}', [catController::class, 'cat_delete'])->name('cat_delete');

Route::post('/inputCat', [catController::class, 'inputCat']);

Route::get('/income', [income::class, 'mergedData'])->name('income');

Route::get('/suplier', [suplierController::class, 'suplier'])->name('suplier');

Route::get('/suplier/{id}/edit', [SuplierController::class, 'edit_suplier'])->name('edit_suplier');

Route::put('/suplier/{id}', [SuplierController::class, 'update_suplier'])->name('edit_suplier');

Route::delete('/suplier/{id}', [SuplierController::class, 'delete_suplier'])->name('edit_suplier');

Route::get('/buy/getData', [BuyController::class, 'getData'])->name('getData');

Route::get('/suplier/search', [BuyController::class, 'search'])->name('search_suplier');

Route::post('/inputSuplier', [suplierController::class, 'inputSuplier']);

Route::put('/customer/{id}', [CustomerController::class, 'update_customer']);

Route::delete('/customer/{id}', [CustomerController::class, 'delete_customer']);

Route::get('/customer', [CustomerController::class, 'customer'])->name('customer');

Route::get('/customer/{id}/edit', [CustomerController::class, 'edit_customer'])->name('edit_customer');

Route::post('/delete-product', [BuyController::class, 'deleteRow']);

Route::post('/inputCustomer', [CustomerController::class, 'inputCustomer']);

Route::post('/delete-sellProduct', [SellController::class, 'delete_row_sell']);

Route::get('/sell/getData_sell', [SellController::class, 'getData_sell'])->name('getData_sell');

Route::delete('/sell/{id}', [SellController::class, 'deleteInvoice']);

Route::delete('/buy/{id}', [BuyController::class, 'deletePurchase']);

Route::get('/storage', [StorageController::class, 'storage'])->name('storage');

Route::get('/storage/getData_storage', [StorageController::class, 'getData_storage'])->name('getData_storage');

// Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

// Auth Route
// Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login');
