<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes(['register' => false]);


Route::get('track/ride-requests/{id}',[\App\Http\Controllers\WEB\RideRequestController::class,'trackRideRequest']);


Route::middleware('auth')->group(function (){
    Route::get('/', [\App\Http\Controllers\WEB\HomeController::class,'index'])->name('home');

    Route::resource('users', \App\Http\Controllers\WEB\UserController::class);
    Route::get('users/{id}/ride-request', [\App\Http\Controllers\WEB\UserController::class,'UserRideRequestList'])->name('users.rideRequest.index');
    Route::get('users/{id}/sos', [\App\Http\Controllers\WEB\UserController::class,'UserSosList'])->name('users.sos.index');


    Route::resource('ride-requests', \App\Http\Controllers\WEB\RideRequestController::class);

    Route::resource('sos-list', \App\Http\Controllers\WEB\SOSController::class)->except('show');
    Route::resource('admins', \App\Http\Controllers\WEB\AdminController::class)->middleware('is_superAdmin')->except('show');
    Route::prefix('settings')->group(function (){
        Route::resource('faqs', \App\Http\Controllers\WEB\FAQController::class)->middleware('is_superAdmin')->except('show');

        Route::get('about-us',[\App\Http\Controllers\WEB\SettingController::class,'getAboutUs'])->name('settings.getAboutUs');
        Route::post('about-us',[\App\Http\Controllers\WEB\SettingController::class,'updateAboutUs'])->name('settings.updateAboutUs');

        Route::get('terms',[\App\Http\Controllers\WEB\SettingController::class,'getTermsCondition'])->name('settings.getTermsCondition');
        Route::post('terms',[\App\Http\Controllers\WEB\SettingController::class,'updateTermsCondition'])->name('settings.updateTermsCondition');

        Route::get('privacy',[\App\Http\Controllers\WEB\SettingController::class,'getPrivacyPolicy'])->name('settings.getPrivacyPolicy');
        Route::post('privacy',[\App\Http\Controllers\WEB\SettingController::class,'updatePrivacyPolicy'])->name('settings.updatePrivacyPolicy');

    })->middleware('is_superAdmin');







});



