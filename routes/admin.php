<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;


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
    Route::get('changepassword', [ProfileController::class, 'changepassword'])->name('changepassword');
    Route::post('updatepassword', [ProfileController::class, 'updatepassword'])->name('updatepassword');


    // Route::post('profile', [CategoryController::class, 'profileupdate'])->name('profile')->name('profile');
});
