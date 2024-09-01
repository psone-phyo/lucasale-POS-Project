<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', function () {
        return view('admin.index');
    });

    Route::get('404', [UserController::class, 'notfound']);
});
