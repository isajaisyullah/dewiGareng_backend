<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserUmkmController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('logout', 'logout');
});


Route::controller(ForgetController::class)->group(function(){
    Route::get('forget-password', 'forgetPassword')->name("forget.password");
    Route::post('forget-password', 'forgetPasswordPost')->name("forget.password.post");

    Route::post('reset-password', 'resetPasswordPost')->name("reset.password.post");
    Route::get('reset-password/{token}', 'resetPassword')->name("reset.password");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified', 'role:SuperAdmin']], function () {
    Route::resource('store', UmkmController::class);
    Route::resource('product', ProductController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('wisata', PaketController::class);
    Route::resource('wisataKategori', WisataController::class);
    Route::resource('profileAll', AdminController::class);
});

Route::group(['middleware' => ['auth', 'verified', 'role:Admin']], function () {
    Route::resource('storeUser', UserUmkmController::class);
    Route::resource('productUser', UserProductController::class);
    Route::resource('profile', AdminController::class);
});

Route::resource('dashboard', DashboardController::class);
