<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::prefix('user')->group( function () {
    Route::post('login',[\App\Http\Controllers\API\LoginController::class,'Login']);
    Route::post('register',[\App\Http\Controllers\API\RegisterController::class,'Register']);


    Route::middleware('auth:api')->group( function () {
        Route::resource('sos', \App\Http\Controllers\API\SOSController::class)->except(['create', 'edit','show']);
        Route::get('profile',[\App\Http\Controllers\API\UserController::class,'UserProfile']);
        Route::post('profile/update/account',[\App\Http\Controllers\API\UserController::class,'updateUserProfile']);
        Route::post('profile/update/password',[\App\Http\Controllers\API\UserController::class,'updateUserPassword']);
        Route::post('profile/request/delete',[\App\Http\Controllers\API\UserController::class,'userProfileDelete']);


        Route::prefix('ride')->group( function () {
            Route::resource('request', \App\Http\Controllers\API\RideController::class)->except(['create', 'edit']);
            Route::post('request/drownies/detect',[\App\Http\Controllers\API\RideController::class,'DetectDrownies']);
            Route::post('twilio/{id}/voice/call',[\App\Http\Controllers\API\RideController::class,'handleVoiceCall']);
        });



    });

    Route::get('settings/aboutus',[\App\Http\Controllers\API\SettingController::class,'getApplicationSettingAboutUs']);
    Route::get('settings/terms',[\App\Http\Controllers\API\SettingController::class,'getApplicationSettingTerms']);
    Route::get('settings/privacy',[\App\Http\Controllers\API\SettingController::class,'getApplicationSettingPrivacy']);
    Route::get('settings/faqs',[\App\Http\Controllers\API\SettingController::class,'getFaqs']);


});







