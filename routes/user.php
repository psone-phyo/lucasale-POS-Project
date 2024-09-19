<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Route::prefix('user')->group(function () {

//     Route::get('home', function () {
//         return view('user.index');
//     });

// });

Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('home/{category_id?}', [UserController::class, 'home'])->name('home');

    Route::get('404', [UserController::class, 'notfound']);
});

