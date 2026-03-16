<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Account_User\AccountController;
use App\Http\Controllers\Api\Account_User\EmployeeController;
use App\Http\Controllers\Api\Account_User\PersonalInfoController;
use App\Http\Controllers\Api\Account_User\UserController;
use App\Http\Controllers\Api\Posts\CommentController;
use App\Http\Controllers\Api\Posts\PostController;
use App\Http\Controllers\Api\Posts\PostImageController;
use App\Http\Controllers\Api\Posts\FavoriteController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\Payments\PayBillController;
use App\Http\Controllers\Api\Payments\PayRuleController;
use App\Http\Controllers\Api\Payments\RechargeBillController;
use App\Http\Controllers\Api\Payments\RechargeRuleController;
use App\Http\Controllers\AuthController;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* API routes for Account_User 
    - AccountController
    - EmployeeController
    - PersonalInfoController
*/

Route::apiResource('accounts', AccountController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('personalInfos', PersonalInfoController::class);

/* API routes for Posts 
    - CommentController
    - PostController
    - PostImageController
    - FavoriteController
*/
Route::middleware('authe:sanctum')->group(function () {
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('postImages', PostImageController::class);
    Route::apiResource('favorites', FavoriteController::class);
});

/* API routes for Form 
    - FormController
*/
Route::apiResource('forms', FormController::class)
    ->middleware('auth:sanctum');

/* API routes for Notification 
    - NotificationController
    - markAsRead method for NotificationController
*/
Route::middleware('authe:sanctum')->group(function () {
    Route::apiResource('notifications', NotificationController::class);
    Route::put('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);
});
/* API routes for Payments 
    - PayBillController
    - PayRuleController
    - RechargeBillController
    - RechargeRuleController
*/
Route::middleware('authe:sanctum')->group(function () {
    Route::apiResource('payBills', PayBillController::class);
    Route::apiResource('payRules', PayRuleController::class);
    Route::apiResource('rechargeBills', RechargeBillController::class);
    Route::apiResource('rechargeRules', RechargeRuleController::class);
});
/* API routes for Auth 
    - AuthController
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');