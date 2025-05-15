<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Advertisement;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\FeedController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PlayerFormController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Provider\AttachmentController;
use App\Http\Controllers\Provider\ClassRoomController;
use App\Http\Controllers\Provider\HomeController as ProviderHomeController;
use App\Http\Controllers\Provider\LessonController;
use App\Http\Controllers\Provider\UnitController;
use App\Http\Controllers\Vendor\DiscountController;
use App\Http\Controllers\Vendor\HomeController as VendorHomeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ChangePhone;
use App\Http\Controllers\Vendor\UserController as VendorUserController;
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
            'player_forms'  => PlayerFormController::class,
            'cities'        => CityController::class,
            'banners'       => BannerController::class,
            'feeds'         => FeedController::class,
            'categories'    => CategoryController::class,
            'users'         => UserController::class,
            'vendors'       => VendorController::class,
            'admins'        => AdminController::class,
            'providers'     => ProviderController::class,
            'ads'           => Advertisement::class,
            'notifications' => NotificationController::class,
            'codes'         => CodeController::class,
        ]);
        Route::get('/check-codes', function () {
            $hasCodes = \App\Models\Code::whereNull('user_id')->exists();
            return response()->json(['has_codes' => $hasCodes]);
        })->name('check.codes');

        Route::post('/codes/destroy-ajax/{id}', [CodeController::class, 'destroyAjax'])->name('destroyAjax');
        Route::get('/admin/codes/export', [CodeController::class, 'exportCodes'])->name('codes.export');

        Route::get('/feed/notification/{id}', [FeedController::class, 'notification'])->name('feed.notification');
        Route::group(['prefix' => 'config'], function () {
            Route::get('/', [ConfigController::class, 'config'])->name('config');
            Route::put('/update/{id}', [ConfigController::class, 'configStore'])->name('configStore');
        });
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
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
        Route::get('/discount-checked/{id}', [VendorUserController::class, 'index'])->name('discount-checked');
    });
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');
    Route::get('/register_vendor', [AuthController::class, 'registerVendor'])->name('register.vendor');
    Route::post('/registerVendorStore', [AuthController::class, 'registerVendorStore'])->name('registerVendorStore');
    Route::get('/register/provider', [AuthController::class, 'registerProvider'])->name('register.provider');
    Route::post('/register/providerStore', [AuthController::class, 'registerProviderStore'])->name('register.providerStore');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'provider', 'as' => 'provider.', 'middleware' => 'checkProvider'], function () {
        Route::get('/', [ProviderHomeController::class, 'index'])->name('index');
        Route::get('/pending', [VendorHomeController::class, 'pending'])->name('pending');
        Route::get('/rejected', [VendorHomeController::class, 'rejected'])->name('rejected');

        Route::group(['prefix' => 'account'], function () {
            Route::get('/', [ProviderHomeController::class, 'account'])->name('account');
            Route::post('/store', [ProviderHomeController::class, 'accountStore'])->name('accountStore');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProviderHomeController::class, 'profile'])->name('profile');
            Route::post('/store', [ProviderHomeController::class, 'profileStore'])->name('profileStore');
        });
        Route::resources([
            'class-rooms' => ClassRoomController::class,
            'units'       => UnitController::class,
            'lessons'     => LessonController::class,
            'attachments' => AttachmentController::class,
        ]);
    });
    Route::get('/verify', [AuthController::class, 'verifyView'])->name('verifyView');
    Route::post('/verify', [AuthController::class, 'verifyVendorStore'])->name('verifyVendorStore');
    Route::post('/verify-provider-store', [AuthController::class, 'verifyProviderStore'])->name('verifyProviderStore');
    Route::post('/resend-code', [AuthController::class, 'resendVerificationCode'])->name('resendVerificationCode');
    Route::post('/provider-resend-code', [AuthController::class, 'providerResendVerificationCode'])->name('providerResendVerificationCode');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/reset-password', [AuthController::class, 'resetPasswordCode'])->name('resetPasswordCode');
    Route::get('/verify-reset-password', [AuthController::class, 'verifyChangePassword'])->name('verifyChangePassword');
    Route::get('/new-password', [AuthController::class, 'newPassword'])->name('newPassword');
    Route::post('/verify-reset-password', [AuthController::class, 'verifyChangePasswordStore'])->name('verifyChangePasswordStore');
    Route::post('/password-resend-code', [AuthController::class, 'passwordResendCode'])->name('passwordResendCode');
    Route::post('/new-password', [AuthController::class, 'newPasswordStore'])->name('newPasswordStore');
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/change-phone', [ChangePhone::class, 'index'])->name("newPhone");
        Route::post('/change-phone', [ChangePhone::class, 'getNewPhone'])->name('getNewPhone');
        Route::get('/verify', [ChangePhone::class, 'verify'])->name('verify');
        Route::post('/verify', [ChangePhone::class, 'verifyCode'])->name('verifyCode');
        Route::post('/resend-code', [ChangePhone::class, 'resendCode'])->name('resendCode');
    });
});
