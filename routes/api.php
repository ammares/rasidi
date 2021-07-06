<?php

use App\Http\Controllers\API\MqttController;
use App\Http\Controllers\API\DevicesController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\GatewaysController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ProvidersController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VerificationController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\StaticContentController;
use Illuminate\Support\Facades\Route;

Route::post('befor_register', [UserController::class, 'beforRegister']);
Route::post('register', [UserController::class, 'register']);
Route::post('befor_login', [UserController::class, 'beforLogin']);
Route::post('login', [UserController::class, 'login']);

Route::group(['prefix' => 'user'], function () {
    Route::post('operations', [UserController::class, 'operations']);
    Route::get('categories', [UserController::class, 'categories']);

});
Route::post('forgot_password', [ForgotPasswordController::class, 'sendCode']);
Route::post('confirm_reset_code', [ForgotPasswordController::class, 'confirmCode']);
Route::post('reset_password', [ForgotPasswordController::class, 'reset']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [UsersController::class, 'logout']);
    Route::post('change_password', [UsersController::class, 'changePassword']);
    Route::post('resend_email_code', [VerificationController::class, 'resendEmailCode']);
    Route::post('verify_email', [VerificationController::class, 'verifyEmail']);




    Route::group(['prefix' => 'gateways'], function () {
        Route::post('register', [GatewaysController::class, 'register']);
    });

    Route::group(['prefix' => 'providers'], function () {
        Route::get('', [ProvidersController::class, 'index']);
    });

    Route::group(['prefix' => 'devices'], function () {
        Route::get('', [DevicesController::class, 'index']);
    });

    Route::group(['prefix' => 'temp'], function () {
        Route::post('mqtt/store', [MqttController::class, 'store']);
    });
});


Route::group(['prefix' => 'static_content'], function () {
    Route::get('introductions', [StaticContentController::class, 'introductions']);
    Route::get('terms_of_use', [StaticContentController::class, 'termsOfUse']);
    Route::get('privacy_policy', [StaticContentController::class, 'privacyPolicy']);
    Route::get('how_it_works_and_key_features', [StaticContentController::class, 'howItWorksAndKeyFeatures']);
});
