<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

    //category
    Route::get('category', [CategoryController::class, 'create'])->name('category');
    Route::post('category', [CategoryController::class,'store']);
    Route::get('category/delete/{id}', [CategoryController::class,'destroy'])->name('deleteCategory');
    Route::get('category/update/{id}', [CategoryController::class, 'editForm'])->name('editform');
    Route::post('category/update/{id}', [CategoryController::class, 'edit']);

});
