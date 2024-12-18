<?php

use App\Http\Controllers\ActionLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

    //category
    Route::get('category', [CategoryController::class, 'create'])->name('category');
    Route::post('category', [CategoryController::class,'store']);
    Route::get('category/delete/{id}', [CategoryController::class,'destroy'])->name('deleteCategory');
    Route::get('category/update/{id}', [CategoryController::class, 'editForm'])->name('editform');
    Route::post('category/update/{id}', [CategoryController::class, 'edit']);
    Route::get('category/categorytable', [CategoryController::class, 'categoryTable'])->name('categoryTable');
    //end category

    //profile
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('profileedit', [ProfileController::class, 'profileeditform'])->name('profileedit');
    Route::post('profileedit', [ProfileController::class, 'profileedit']);
    Route::get('changepassword', [ProfileController::class, 'changepassword'])->name('changepassword');
    Route::post('updatepassword', [ProfileController::class, 'updatepassword'])->name('updatepassword');

    //superadmin middleware
    Route::group(['middleware' => 'superadmin'], function(){
        //add admin
        Route::get('createadmin', [ProfileController::class, 'createadmin'])->name('createadmin');
        Route::group(['prefix' => 'payment'], function(){
            Route::get('/', [PaymentController::class, 'payment'])->name('payment');
            Route::post('store', [PaymentController::class, 'store'])->name('paymentstore');
            Route::get('edit/{id}', [PaymentController::class, 'edit'])->name('editpayment');
            Route::post('edit/{id}', [PaymentController::class, 'update']);
            Route::get('delete/{id}', [PaymentController::class, 'destroy'])->name('deletepayment');
        });
    });

    //admin list and user list
    Route::get('adminlist', [ProfileController::class,'adminlist'])->name('adminlist');
    Route::get('userlist', [ProfileController::class,'userlist'])->name('userlist');
    Route::get('list/delete/{id}', [ProfileController::class, 'listdelete'])->name('listdelete');

    //product
    Route::get('createproduct', [ProductController::class, 'create'])->name('createproduct');
    Route::post('createproduct', [ProductController::class, 'store']);
    Route::get('productlist/{lowamt?}', [ProductController::class, 'list'])->name('productlist');
    Route::get('product-update/{id}', [ProductController::class, 'editform'])->name('editproduct');
    Route::post('product-update/{id}', [ProductController::class, 'edit']);
    Route::get('product-view/{id}', [ProductController::class, 'view'])->name('viewproduct');
    Route::get('product-delete/{id}', [ProductController::class, 'destroy'])->name('productdelete');

    //Payment


    //order
    Route::group(['prefix' => 'order'], function(){
        Route::get('orderlist', [OrderController::class, 'orderlist'])->name('orderlist');
        Route::get('orderdetails/{ordercode}', [OrderController::class, 'details'])->name('orderdetails');
        Route::get('statuschange', [OrderController::class, 'statuschange'])->name('statuschange');
        Route::get('saleinformation', [OrderController::class, 'approvedlist'])->name('saleinformation');
    });

    Route::get('feedback',[FeedbackController::class, 'feedback'])->name('feedback');

});
