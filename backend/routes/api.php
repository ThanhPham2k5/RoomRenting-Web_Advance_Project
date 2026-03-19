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


/* API routes for Account_User 
    - AccountController
    - EmployeeController
    - PersonalInfoController
*/

//Account
Route::middleware(['auth:sanctum', 'permission:view account'])->group(function(){
    Route::get('/accounts/{account}', [AccountController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all account'])->group(function(){
    Route::get('/accounts', [AccountController::class, 'index']);
});
    


//User
Route::middleware(['auth:sanctum', 'permission:view user'])->group(function(){
    Route::get('/users/{user}', [UserController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'permission:view all user'])->group(function(){
    Route::get('/users', [UserController::class, 'index']);
});
    


//Employee
Route::middleware(['auth:sanctum', 'permission:view employee'])->group(function(){
    Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all employee'])->group(function(){
    Route::get('/employees', [EmployeeController::class, 'index']);  
});
    


//PersonalInfo
Route::middleware(['auth:sanctum', 'permission:view personalInfo'])->group(function(){
    Route::get('/personalInfos/{personalInfo}', [PersonalInfoController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all personalInfo'])->group(function(){
    Route::get('/personalInfos', [PersonalInfoController::class, 'index']);
});
    
//TODO: replace with permissions
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


//Post
Route::middleware(['auth:sanctum', 'permission:view post'])->group(function(){
    Route::get('/posts/{post}', [PostController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all post'])->group(function(){
    Route::get('/posts', [PostController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create post'])->group(function(){
    Route::get('/posts', [PostController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update post'])->group(function(){
    Route::get('/posts/{post}', [PostController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete post'])->group(function(){
    Route::get('/posts/{post}', [PostController::class, 'destroy']);
});



//Comment
Route::middleware(['auth:sanctum', 'permission:view comment'])->group(function(){
    Route::get('/comments/{comment}', [CommentController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all comment'])->group(function(){
    Route::get('/comments', [CommentController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create comment'])->group(function(){
    Route::get('/comments', [CommentController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update comment'])->group(function(){
    Route::get('/comments/{comment}', [CommentController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete comment'])->group(function(){
    Route::get('/comments/{comment}', [CommentController::class, 'destroy']);
});


//TODO: replace with permissions
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('postImages', PostImageController::class);
    Route::apiResource('favorites', FavoriteController::class);
});

/* API routes for Form 
    - FormController
*/
//Form
Route::middleware(['auth:sanctum', 'permission:view form'])->group(function(){
    Route::get('/forms/{form}', [FormController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all form'])->group(function(){
    Route::get('/forms', [FormController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create form'])->group(function(){
    Route::get('/forms', [FormController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update form'])->group(function(){
    Route::get('/forms/{form}', [FormController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete form'])->group(function(){
    Route::get('/forms/{form}', [FormController::class, 'destroy']);
});

//TODO: replace with permissions
Route::apiResource('forms', FormController::class)
    ->middleware('auth:sanctum');



/* API routes for Notification 
    - NotificationController
    - markAsRead method for NotificationController
*/
//Notification
Route::middleware(['auth:sanctum', 'permission:view notification'])->group(function(){
    Route::get('/notifications/{notification}', [NotificationController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all notification'])->group(function(){
    Route::get('/notifications', [NotificationController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create notification'])->group(function(){
    Route::get('/notifications', [NotificationController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update notification'])->group(function(){
    Route::get('/notifications/{notification}', [NotificationController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete notification'])->group(function(){
    Route::get('/notifications/{notification}', [NotificationController::class, 'destroy']);
});

//TODO: replace with permissions
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('notifications', NotificationController::class);
    Route::put('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);
});



/* API routes for Payments 
    - PayBillController
    - PayRuleController
    - RechargeBillController
    - RechargeRuleController
*/
//PayBill
Route::middleware(['auth:sanctum', 'permission:view payBill'])->group(function(){
    Route::get('/payBills/{payBill}', [PayBillController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all payBill'])->group(function(){
    Route::get('/payBills', [PayBillController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create payBill'])->group(function(){
    Route::get('/payBills', [PayBillController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update payBill'])->group(function(){
    Route::get('/payBills/{payBill}', [PayBillController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete payBill'])->group(function(){
    Route::get('/payBills/{payBill}', [PayBillController::class, 'destroy']);
});



//PayRule
Route::middleware(['auth:sanctum', 'permission:view payRule'])->group(function(){
    Route::get('/payRules/{payRule}', [PayRuleController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all payRule'])->group(function(){
    Route::get('/payRules', [PayRuleController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create payRule'])->group(function(){
    Route::get('/payRules', [PayRuleController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update payRule'])->group(function(){
    Route::get('/payRules/{payRule}', [PayRuleController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete payRule'])->group(function(){
    Route::get('/payRules/{payRule}', [PayRuleController::class, 'destroy']);
});



//RechargeBill
Route::middleware(['auth:sanctum', 'permission:view rechargeBill'])->group(function(){
    Route::get('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all rechargeBill'])->group(function(){
    Route::get('/rechargeBills', [RechargeBillController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create rechargeBill'])->group(function(){
    Route::get('/rechargeBills', [RechargeBillController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update rechargeBill'])->group(function(){
    Route::get('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete rechargeBill'])->group(function(){
    Route::get('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'destroy']);
});



//RechargeRule
Route::middleware(['auth:sanctum', 'permission:view rechargeRule'])->group(function(){
    Route::get('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:view all rechargeRule'])->group(function(){
    Route::get('/rechargeRules', [RechargeRuleController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:create rechargeRule'])->group(function(){
    Route::get('/rechargeRules', [RechargeRuleController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:update rechargeRule'])->group(function(){
    Route::get('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:delete rechargeRule'])->group(function(){
    Route::get('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'destroy']);
});

//TODO: replace with permissions
Route::middleware('auth:sanctum')->group(function () {
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