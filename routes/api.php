<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\HomeController as ApiHomeController;

Route::group(['middleware' => 'lang'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
        Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:api')->name('profile');
        Route::post('/profile/update', [AuthController::class, 'profileUpdate'])->middleware('auth:api')->name('profileUpdate');
    });
    Route::get('/config', [ConfigController::class, 'config'])->name('config');
    Route::get('/home', [ConfigController::class, 'homePage'])->name('homePage');
    Route::get('/vendors/{category_id}', [ApiHomeController::class, 'vendorsByCategoryId'])->name('vendor');
    Route::get('/vendor/{id}', [ApiHomeController::class, 'vendorDetails'])->name('vendorDetails');
    Route::get('/search', [ApiHomeController::class, 'search'])->name('search');
});
