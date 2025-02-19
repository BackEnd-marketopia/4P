<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\HomeController as ApiHomeController;
use App\Http\Controllers\Api\NotificationController;

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
    Route::get('/categories', [ApiHomeController::class, 'categories'])->name('categories');
    Route::get('/feeds', [ApiHomeController::class, 'feeds'])->name('feeds');
    Route::get('/feed/details/{id}', [ApiHomeController::class, 'feedDetails'])->name('feedDetails');

    Route::get('/vendors/{category_id}', [ApiHomeController::class, 'vendorsByCategoryId'])->name('vendor');
    Route::get('/vendor/{id}', [ApiHomeController::class, 'vendorDetails'])->name('vendorDetails');
    Route::get('/search', [ApiHomeController::class, 'search'])->name('search');
    Route::get('/discount/{id}', [DiscountController::class, 'index'])->name('discount');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/player_form', [ApiHomeController::class, 'playerForm'])->name('playerForm');
        Route::post('/discountChecked/{discountId}', [DiscountController::class, 'discountChecked'])->name('discountChecked');
        Route::get('/attachments/{lessonId}', [EducationController::class, 'attachments'])->name('attachments');
    });
    Route::group(['prefix' => 'notification'], function () {
        Route::get('/', [NotificationController::class, 'getNotifications'])->name('getNotifications');
    });
    Route::get('/educationDepartment', [EducationController::class, 'educationDepartment'])->name('educationDepartment');
    Route::get('/providers/{educationDepartmentId}', [EducationController::class, 'providers'])->name('providers');
    Route::get('/class_rooms/{providerId}', [EducationController::class, 'classRooms'])->name('class_rooms');
    Route::get('/units/{classRoomId}', [EducationController::class, 'units'])->name('units');
    Route::get('/lessons/{unitId}', [EducationController::class, 'lessons'])->name('lessons');
    Route::get('/ads-clicked/{id}', [ConfigController::class, 'clickedAds'])->name('clickedAds');
});
