<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
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
        Route::get('orderdetails/{ordercode}', [OrderController::class, 'details'])->name('user#orderdetails');

    });

    Route::get('contact', [ContactController::class, 'contact'])->name('user#contact');
    Route::post('contact', [ContactController::class, 'store']);
    Route::post('store', [CommentController::class, 'store'])->name('comment');
    Route::post('rating', [RatingController::class, 'rating'])->name('rating');


    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', [ProfileController::class, 'profile'])->name('user#profile');
        Route::get('profileEdit', [ProfileController::class, 'profileeditform'])->name('user#profileedit');
        Route::post('profileEdit', [ProfileController::class, 'profileedit']);
        Route::get('changepassword', [ProfileController::class, 'changepassword'])->name('user#updatepassword');
        Route::post('changepassword', [ProfileController::class, 'updatepassword']);
    });

    //user comment
    Route::get('comment/delete/{id}', [CommentController::class, 'delete'])->name('user#commentDelete');
    Route::get('comment/edit', [CommentController::class, 'edit'])->name('user#commentEdit');


});

