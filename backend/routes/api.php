<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Account_User\AccountController;
use App\Http\Controllers\Api\Account_User\EmployeeController;
use App\Http\Controllers\Api\Account_User\PersonalInfoController;
use App\Http\Controllers\Api\Posts\CommentController;
use App\Http\Controllers\Api\Posts\PostController;
use App\Http\Controllers\Api\Posts\PostImageController;
use App\Http\Controllers\Api\Posts\FavoriteController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\Payments\PayBillController;
use App\Http\Controllers\Api\Payments\PayRuleController;
use App\Http\Controllers\Api\Payments\RechargeBillController;
use App\Http\Controllers\Api\Payments\RechargeRuleController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* API routes for Account_User 
    - AccountController
    - EmployeeController
    - PersonalInfoController
*/
Route::group(['prefix' => 'Account_User', 'namespace' => 'App\Http\Controllers\Api\Account_User'], function () {
    Route::apiResource('Account', AccountController::class);
    Route::apiResource('Employee', EmployeeController::class);
    Route::apiResource('PersonalInfo', PersonalInfoController::class);
});

/* API routes for Posts 
    - CommentController
    - PostController
    - PostImageController
    - FavoriteController
*/
Route::group(['prefix' => 'Posts', 'namespace' => 'App\Http\Controllers\Api\Posts'], function () {
    Route::apiResource('Comment', CommentController::class);
    Route::apiResource('Post', PostController::class);
    Route::apiResource('PostImage', PostImageController::class);
    Route::apiResource('Favorite', FavoriteController::class);
});

/* API routes for Form 
    - FormController
*/
Route::group(['prefix' => 'Form', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::apiResource('Form', FormController::class);
});

/* API routes for Payments 
    - PayBillController
    - PayRuleController
    - RechargeBillController
    - RechargeRuleController
*/
Route::group(['prefix' => 'Payments', 'namespace' => 'App\Http\Controllers\Api\Payments'], function () {
    Route::apiResource('PayBill', PayBillController::class);
    Route::apiResource('PayRule', PayRuleController::class);
    Route::apiResource('RechargeBill', RechargeBillController::class);
    Route::apiResource('RechargeRule', RechargeRuleController::class);
});