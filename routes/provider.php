<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('auth/{provider}/redirect', [LoginController::class, 'redirect'])->name('redirect');
Route::get('auth/{provider}/callback', [LoginController::class, 'callback'])->name('callback');
