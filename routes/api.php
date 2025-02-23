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
use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    Route::get('/user-stats', function () {
        $activeUsers = DB::table('users')
            ->where('user_type', 'user')
            ->where('status', 'active')
            ->selectRaw('
        MONTH(users.created_at) as month, 
        COUNT(users.id) as total_active_users
    ')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $subscribedUsers = DB::table('codes')
            ->join('users', 'users.id', '=', 'codes.user_id')
            ->where('users.user_type', 'user')
            ->whereNotNull('codes.user_id')
            ->selectRaw('
        MONTH(codes.updated_at) as month, 
        COUNT(DISTINCT codes.user_id) as total_subscribed_users
    ')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $stats = [];

        foreach ($activeUsers as $user) {
            $stats[$user->month] = [
                'month' => $user->month,
                'total_active_users' => $user->total_active_users,
                'total_subscribed_users' => 0,
            ];
        }

        foreach ($subscribedUsers as $sub) {
            if (isset($stats[$sub->month])) {
                $stats[$sub->month]['total_subscribed_users'] = $sub->total_subscribed_users;
            } else {
                $stats[$sub->month] = [
                    'month' => $sub->month,
                    'total_active_users' => 0,
                    'total_subscribed_users' => $sub->total_subscribed_users,
                ];
            }
        }

        return response()->json(array_values($stats));
    });
});
