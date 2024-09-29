<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\user\PaymentController;
use App\Http\Controllers\User\ProductController;

// Route::prefix('user')->group(function () {

//     Route::get('home', function () {
//         return view('user.index');
//     });

// });

Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('home/{category_id?}', [UserController::class, 'home'])->name('home');

    Route::group(['prefix' => 'product'], function(){
        Route::get('details/{id}', [ProductController::class, 'details'])->name('details');
        Route::get('cart', [ProductController::class, 'cart'])->name('cart');
        Route::post('addToCart/{id}', [ProductController::class, 'addToCart'])->name('addToCart');
        Route::get('delete', [ProductController::class, 'delete'])->name('deletecart');

        //api
        Route::get('apitest', [ProductController::class, 'apitest'])->name('apitest');

        //order and cart
        Route::get('confirmcart', [ProductController::class, 'confirmcart'])->name('confirmcart');
        Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
        Route::post('order', [PaymentController::class, 'order'])->name('order');
        Route::get('orderlist', [PaymentController::class, 'orderlist'])->name('user#orderlist');





    });
});

