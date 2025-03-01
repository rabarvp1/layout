<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\catController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\suplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () {

    Route::middleware(['auth'])->group(function () {

        //dashboard route
        Route::get('/', [ProductController::class, 'first'])->name('first');

        Route::get('/test', [AuthController::class, 'test'])->name('test');

        // Product Routes
        Route::middleware('role:Product')->group(function () {
            Route::get('/product/view', [ProductController::class, 'product']);
            Route::get('/product', [ProductController::class, 'index'])->name('products.index');
            Route::get('/product/search', [ProductController::class, 'search_cat'])->name('search_cat');
            Route::post('/product/insert', [ProductController::class, 'insertProduct']);
            Route::delete('/product/delete{id}', [ProductController::class, 'deleteProduct']);
            Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
            Route::put('/product/update/{id}', [ProductController::class, 'updateProduct']);
        });

        // Buy Routes
        Route::middleware('role:purchase')->group(function () {

            Route::get('/buy/view', [BuyController::class, 'buy'])->name('buy');
            Route::get('/buy', [BuyController::class, 'buy_index'])->name('buy_index');
            Route::get('/buy/data', [BuyController::class, 'getPurchases'])->name('buy.data');
            Route::get('/buy/single/view/{id}', [BuyController::class, 'view_purchase'])->name('view_purchase');
            Route::get('/buy/edit/{id}', [BuyController::class, 'edit_purchase'])->name('edit_purchase');
            Route::put('/buy/update/{id}', [BuyController::class, 'purchase_update']);
            Route::post('/buy/insert', [BuyController::class, 'buy_insert']);
            Route::get('/buy/getData', [BuyController::class, 'getData'])->name('getData');
            Route::get('/suplier/search', [BuyController::class, 'search'])->name('search_suplier');
            Route::delete('/buy/delete/{id}', [BuyController::class, 'deletePurchase']);
        });

        // Admin Routes
        Route::middleware('role:user')->group(function () {

            Route::get('/users/view', [AuthController::class, 'users'])->name('users');
            Route::get('/users/view/create', [AuthController::class, 'user_create'])->name('user_create');
            Route::post('/users/create', [AuthController::class, 'create'])->name('create');
            Route::get('/users/edit/{id}', [AuthController::class, 'edit_user'])->name('edit_user');
            Route::put('/users/update/{id}', [AuthController::class, 'update_user'])->name('update_user');
            Route::delete('/users/delete/{id}', [AuthController::class, 'delete'])->name('delete_user');
            Route::get('/users', [AuthController::class, 'user_index'])->name('user_index');
            Route::get('/users/change-password', [AuthController::class, 'change_password']);
            Route::post('/users/change_password/update', [AuthController::class, 'change_password_update']);
        });

        // Sell Routes
        Route::middleware('role:sell')->group(function () {
            Route::get('/sell/view', [SellController::class, 'sell'])->name('sell');
            Route::get('/sell', [SellController::class, 'sell_index'])->name('sell_index');
            Route::get('/sell/single/view/{id}', [SellController::class, 'view_invoice'])->name('view_invoice');
            Route::get('/sell/edit/{id}', [SellController::class, 'edit_invoice'])->name('edit_invoice');
            Route::put('/sell/update/{id}', [SellController::class, 'update_invoice']);
            Route::get('/customer/search', [SellController::class, 'search_customer'])->name('search_customer');
            Route::post('/insert_sell', [SellController::class, 'insert_sell']);
            Route::post('/delete-sellProduct', [SellController::class, 'delete_row_sell']);
            Route::get('/sell/getData_sell', [SellController::class, 'getData_sell'])->name('getData_sell');
            Route::delete('/sell/delete/{id}', [SellController::class, 'deleteInvoice']);
        });

        // Category Routes

        Route::middleware('role:cat')->group(function () {
            Route::get('/cat/view', [catController::class, 'cat'])->name('cat');
            Route::get('/cat', [catController::class, 'cat_index'])->name('cat.index');
            Route::get('/cat/edit/{id}', [catController::class, 'cat_edit'])->name('cat_edit');
            Route::put('/cat/update/{id}', [catController::class, 'cat_update'])->name('cat_update');
            Route::delete('/cat/delete/{id}', [catController::class, 'cat_delete'])->name('cat_delete');
            Route::post('/cat/insert', [catController::class, 'inputCat']);
        });

        // Supplier Routes
        Route::middleware('role:supplier')->group(function () {
            Route::get('/suplier/view', [suplierController::class, 'suplier'])->name('suplier');
            Route::get('/suplier', [suplierController::class, 'suplier_index'])->name('suplier_index');
            Route::post('/supplier/insert', [suplierController::class, 'inputSuplier']);
            Route::get('/suplier/edit/{id}', [SuplierController::class, 'edit_suplier'])->name('edit_suplier');
            Route::put('/suplier/update/{id}', [SuplierController::class, 'update_suplier'])->name('edit_suplier');
            Route::get('/suplier/profile/{id}', [PaymentController::class, 'profile_suplier'])->name('profile_suplier');
            Route::delete('/suplier/delete/{id}', [SuplierController::class, 'delete_suplier'])->name('delete_suplier');
            Route::post('/suplier/payment/{id}', [PaymentController::class, 'suplier_payment']);
            Route::put('/suplier/profile/update/{paymentId}/{suplierId}', [PaymentController::class, 'update_suplier_profile']);
            Route::get('/suplier/profile/edit/{paymentId}/{suplierId}', [PaymentController::class, 'edit_suplier_profile'])->name('edit_suplier_profile');
            Route::delete('/suplier/delete/payment/{paymentId}', [PaymentController::class, 'delete_payment']);
            Route::get('/suplier/payment/get', [PaymentController::class, 'suplier_payment_index'])->name('payments.get');
        });

        // Customer Routes
        Route::middleware('role:customer')->group(function () {
            Route::get('/customer/view', [CustomerController::class, 'customer'])->name('customer');
            Route::get('/customer', [CustomerController::class, 'customer_index'])->name('customer_index');
            Route::get('/customer/edit/{id}', [CustomerController::class, 'edit_customer'])->name('edit_customer');
            Route::put('/customer/update/{id}', [CustomerController::class, 'update_customer']);
            Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete_customer']);
            Route::get('/customer/profile/{id}', [PaymentController::class, 'profile_customer'])->name('profile_customer');
            Route::post('/customer/payment/{id}', [PaymentController::class, 'customer_payment']);
            Route::delete('/customer/delete/payment/{id}', [PaymentController::class, 'delete_payment_customer']);
            Route::get('/customer/profile/edit/{paymentId}/{customerId}', [PaymentController::class, 'edit_customer_profile'])->name('edit_customer_profile');
            Route::put('/customer/profile/update/{paymentId}/{customerId}', [PaymentController::class, 'update_customer_profile']);
            Route::post('/customer/insert', [CustomerController::class, 'inputCustomer']);
            Route::get('/customer/payment/get', [PaymentController::class, 'customer_payment_index'])->name('customer.get');

        });

        // Storage Routes
        // Storage Routes
        Route::middleware('role:storage')->group(function () {
            Route::get('/storage/view', [StorageController::class, 'storage'])->name('storage');
            Route::get('/storage/getData_storage', [StorageController::class, 'getData_storage'])->name('getData_storage');
        });

        // Locale Route
        Route::get('/locale/{locale}/{direction}', function ($locale, $direction) {
            abort_unless(in_array($locale, ['en', 'ar', 'ku']), 404);
            abort_unless(in_array($direction, ['rtl', 'ltr']), 404);

            session([
                'locale'    => $locale,
                'direction' => $direction,
            ]);

            return back();
        })->name('change-lang');

    });

    // Auth Routes
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
