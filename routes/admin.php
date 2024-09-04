<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

});
