<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLogin;

Route::get('/', function () {
        return view('login');
});

Route::controller(AuthController::class)->group( function(){
        Route::get('/login', 'getLoginPage')->name('login');
        Route::get('/register', 'getRegisterPage')->name('register');

        Route::post('/login-post', 'login')->name('login.post');
        Route::post('/register-post', 'register')->name('register.post');

        Route::post('/logout', 'logout')->name('logout');
});

Route::controller(ProductController::class)->middleware(IsAdmin::class)->group( function(){
        //admin
        Route::get('/admin/dashboard', 'getAdminDashboard')->name('admin.dashboard');
        Route::get('/admin/create-product', 'getCreatePage')->name('product.create.page');
        Route::post('/admin/create-product', 'createProduct')->name('product.create');

        Route::get('/admin/update-product/{id}', 'getUpdatePage')->name('product.update.page');
        Route::patch('/admin/update-product/{id}', 'updateProduct')->name('product.update');

        Route::delete('/admin/delete-product/{id}', 'deleteProduct')->name('product.delete');
});

Route::middleware(IsLogin::class)->group(function () {
        Route::get('/user/dashboard', [ProductController::class, 'getUserDashboard'])->name('user.dashboard');

        Route::controller(CartController::class)->group(function () {
                Route::post('/user/add-to-cart/{id}', 'addProductToCart')->name('add.cart');
                Route::get('/user/cart',  'getCart')->name('cart');
                Route::delete('/user/cart/{id}', 'deleteProductInCart')->name('delete.cart.item');
                Route::post('/user/cart/{id}/{PoM}', 'plusOrMinusItemQty')->name('edit.cart.item.qty');

                Route::get('/user/histories', 'getOrderpage')->name('orders.get');
                Route::post('/user/submit-cart', 'submitCart')->name('submit.order');
        });
        });



