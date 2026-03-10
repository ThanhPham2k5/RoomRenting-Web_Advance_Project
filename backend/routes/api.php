<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Account_User\AccountController;
use App\Http\Controllers\Api\Account_User\EmployeeController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'Account_User', 'namespace' => 'App\Http\Controllers\Api\Account_User'], function () {
    Route::apiResource('Account', AccountController::class);
    Route::apiResource('Employee', EmployeeController::class);
});