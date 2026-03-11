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
use App\Http\Controllers\UserController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* API routes for Account_User 
    - AccountController
    - EmployeeController
    - PersonalInfoController
*/

Route::apiResource('accounts', AccountController::class);
Route::apiResources('users', UserController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('personalInfos', PersonalInfoController::class);

/* API routes for Posts 
    - CommentController
    - PostController
    - PostImageController
    - FavoriteController
*/
Route::apiResource('comments', CommentController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('postImages', PostImageController::class);
Route::apiResource('favorites', FavoriteController::class);

/* API routes for Form 
    - FormController
*/
Route::apiResource('forms', FormController::class);

/* API routes for Payments 
    - PayBillController
    - PayRuleController
    - RechargeBillController
    - RechargeRuleController
*/
Route::apiResource('payBills', PayBillController::class);
Route::apiResource('payRules', PayRuleController::class);
Route::apiResource('rechargeBills', RechargeBillController::class);
Route::apiResource('rechargeRules', RechargeRuleController::class);