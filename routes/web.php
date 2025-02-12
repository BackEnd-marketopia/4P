<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\FeedController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PlayerFormController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Vendor\DiscountController;
use App\Http\Controllers\Vendor\HomeController as VendorHomeController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar']))
        session()->put('locale', $locale);
    return redirect()->back();
})->name('setLocale');

Route::group(['middleware' => 'WebLang'], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'checkAdmin'], function () {

        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [HomeController::class, 'profileMe'])->name('profileMe');
            Route::post('/update', [HomeController::class, 'profileMeSotre'])->name('profileMeSotre');
        });
        Route::resources([
            'player_forms' => PlayerFormController::class,
            'cities'     => CityController::class,
            'banners'    => BannerController::class,
            'feeds'      => FeedController::class,
            'categories' => CategoryController::class,
            'users'      => UserController::class,
            'vendors'    => VendorController::class,
            'admins'     => AdminController::class,
        ]);
        Route::group(['prefix' => 'config'], function () {
            Route::get('/', [ConfigController::class, 'config'])->name('config');
            Route::put('/update/{id}', [ConfigController::class, 'configStore'])->name('configStore');
        });
    });
    Route::group(['prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => 'checkVendor'], function () {
        Route::get('/', [VendorHomeController::class, 'home'])->name('home');
        Route::get('/pending', [VendorHomeController::class, 'pending'])->name('pending');
        Route::get('/rejected', [VendorHomeController::class, 'rejected'])->name('rejected');
        Route::resources([
            'discounts' => DiscountController::class,
        ]);

        Route::group(['prefix' => 'account'], function () {
            Route::get('/', [VendorHomeController::class, 'account'])->name('account');
            Route::post('/update', [VendorHomeController::class, 'accountSotre'])->name('accountSotre');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [VendorHomeController::class, 'profile'])->name('profile');
            Route::post('/update', [VendorHomeController::class, 'profileSotre'])->name('profileSotre');
        });
    });
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerStore', [AuthController::class, 'registerStore'])->name('registerStore');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
