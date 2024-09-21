<?php

use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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


    });
});

