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
Route::middleware(['auth:sanctum', 'permission:account.get'])->group(function(){
    Route::get('/accounts/{account}', [AccountController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:account.getAll'])->group(function(){
    Route::get('/accounts', [AccountController::class, 'index']);
});
    


//User
Route::middleware(['auth:sanctum', 'permission:user.get'])->group(function(){
    Route::get('/users/{user}', [UserController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'permission:user.getAll'])->group(function(){
    Route::get('/users', [UserController::class, 'index']);
});
    


//Employee
Route::middleware(['auth:sanctum', 'permission:employee.get'])->group(function(){
    Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:employee.getAll'])->group(function(){
    Route::get('/employees', [EmployeeController::class, 'index']);  
});
    


//PersonalInfo
Route::middleware(['auth:sanctum', 'permission:personalInfo.get'])->group(function(){
    Route::get('/personalInfos/{personalInfo}', [PersonalInfoController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:personalInfo.getAll'])->group(function(){
    Route::get('/personalInfos', [PersonalInfoController::class, 'index']);
});
    
//TODO: replace with permissions
// Route::apiResource('accounts', AccountController::class);
// Route::apiResource('users', UserController::class);
// Route::apiResource('employees', EmployeeController::class);
// Route::apiResource('personalInfos', PersonalInfoController::class);

/* API routes for Posts 
    - CommentController
    - PostController
    - PostImageController
    - FavoriteController
*/


//Post
Route::middleware(['auth:sanctum','permission:post.get'])->group(function(){
    Route::get('/posts/{post}', [PostController::class, 'show']);
});
    
Route::middleware(['auth:sanctum','permission:post.getAll'])->group(function(){
    Route::get('/posts', [PostController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:post.create'])->group(function(){
    Route::post('/posts', [PostController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:post.update'])->group(function(){
    Route::put('/posts/{post}', [PostController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:post.delete'])->group(function(){
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});



//Comment
Route::middleware(['auth:sanctum','permission:comment.get'])->group(function(){
    Route::get('/comments/{comment}', [CommentController::class, 'show']);
});
    
Route::middleware(['auth:sanctum','permission:comment.getAll'])->group(function(){
    Route::get('/comments', [CommentController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:comment.create'])->group(function(){
    Route::post('/comments', [CommentController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:comment.update'])->group(function(){
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:comment.delete'])->group(function(){
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});


//Favorite
Route::middleware(['auth:sanctum','permission:favorite.get'])->group(function(){
    Route::get('/favorites/{favorite}', [FavoriteController::class, 'show']);
});
    
Route::middleware(['auth:sanctum','permission:favorite.getAll'])->group(function(){
    Route::get('/favorites', [FavoriteController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:favorite.create'])->group(function(){
    Route::post('/favorites', [FavoriteController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:favorite.update'])->group(function(){
    Route::put('/favorites/{favorite}', [FavoriteController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:favorite.delete'])->group(function(){
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy']);
});



//TODO: replace with permissions
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('comments', CommentController::class);
//     Route::apiResource('posts', PostController::class);
//     Route::apiResource('postImages', PostImageController::class);
//     Route::apiResource('favorites', FavoriteController::class);
// });

/* API routes for Form 
    - FormController
*/
//Form
Route::middleware(['auth:sanctum', 'permission:form.get'])->group(function(){
    Route::get('/forms/{form}', [FormController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:form.getAll'])->group(function(){
    Route::get('/forms', [FormController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:form.create'])->group(function(){
    Route::post('/forms', [FormController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:form.update'])->group(function(){
    Route::put('/forms/{form}', [FormController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:form.delete'])->group(function(){
    Route::delete('/forms/{form}', [FormController::class, 'destroy']);
});
Route::middleware(['auth:sanctum', 'permission:form.getRecommendation'])
    ->get('/forms/recommendations', [FormController::class, 'getRecommendedPosts']);


//TODO: replace with permissions
// Route::middleware('auth:sanctum')
//     ->get('/forms/recommendations', [FormController::class, 'getRecommendedPosts']);
// Route::apiResource('forms', FormController::class)
//     ->middleware('auth:sanctum');



/* API routes for Notification 
    - NotificationController
    - markAsRead method for NotificationController
*/
//Notification
Route::middleware(['auth:sanctum', 'permission:notification.get'])->group(function(){
    Route::get('/notifications/{notification}', [NotificationController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:notification.getAll'])->group(function(){
    Route::get('/notifications', [NotificationController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:notification.create'])->group(function(){
    Route::post('/notifications', [NotificationController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:notification.update'])->group(function(){
    Route::put('/notifications/{notification}', [NotificationController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:notification.delete'])->group(function(){
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy']);
});

//TODO: replace with permissions
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('notifications', NotificationController::class);
//     Route::put('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead']);
// });



/* API routes for Payments 
    - PayBillController
    - PayRuleController
    - RechargeBillController
    - RechargeRuleController
*/
//PayBill
Route::middleware(['auth:sanctum', 'permission:payBill.get'])->group(function(){
    Route::get('/payBills/{payBill}', [PayBillController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:payBill.getAll'])->group(function(){
    Route::get('/payBills', [PayBillController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:payBill.create'])->group(function(){
    Route::post('/payBills', [PayBillController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:payBill.update'])->group(function(){
    Route::put('/payBills/{payBill}', [PayBillController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:payBill.delete'])->group(function(){
    Route::delete('/payBills/{payBill}', [PayBillController::class, 'destroy']);
});



//PayRule
Route::middleware(['auth:sanctum', 'permission:payRule.get'])->group(function(){
    Route::get('/payRules/{payRule}', [PayRuleController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:payRule.getAll'])->group(function(){
    Route::get('/payRules', [PayRuleController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:payRule.create'])->group(function(){
    Route::post('/payRules', [PayRuleController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:payRule.update'])->group(function(){
    Route::put('/payRules/{payRule}', [PayRuleController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:payRule.delete'])->group(function(){
    Route::delete('/payRules/{payRule}', [PayRuleController::class, 'destroy']);
});



//RechargeBill
Route::middleware(['auth:sanctum', 'permission:rechargeBill.get'])->group(function(){
    Route::get('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:rechargeBill.getAll'])->group(function(){
    Route::get('/rechargeBills', [RechargeBillController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:rechargeBill.create'])->group(function(){
    Route::post('/rechargeBills', [RechargeBillController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:rechargeBill.update'])->group(function(){
    Route::put('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:rechargeBill.delete'])->group(function(){
    Route::delete('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'destroy']);
});



//RechargeRule
Route::middleware(['auth:sanctum', 'permission:rechargeRule.get'])->group(function(){
    Route::get('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'show']);
});
    
Route::middleware(['auth:sanctum', 'permission:rechargeRule.getAll'])->group(function(){
    Route::get('/rechargeRules', [RechargeRuleController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'permission:rechargeRule.create'])->group(function(){
    Route::post('/rechargeRules', [RechargeRuleController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:rechargeRule.update'])->group(function(){
    Route::put('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'permission:rechargeRule.delete'])->group(function(){
    Route::delete('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'destroy']);
});

//TODO: replace with permissions
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('payBills', PayBillController::class);
//     Route::apiResource('payRules', PayRuleController::class);
//     Route::apiResource('rechargeBills', RechargeBillController::class);
//     Route::apiResource('rechargeRules', RechargeRuleController::class);
// });


/* API routes for Auth 
    - AuthController
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');