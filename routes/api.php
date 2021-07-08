<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('before_register', [UserController::class, 'beforeRegister']);
Route::post('register', [UserController::class, 'register']);
Route::post('before_login', [UserController::class, 'beforeLogin']);
Route::post('login', [UserController::class, 'login']);

Route::group(['prefix' => 'user'], function () {
    Route::post('operations', [UserController::class, 'operations']);
    Route::get('categories', [UserController::class, 'categories']);

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('transfer_operations', [AdminController::class, 'transferOperations']);
});
