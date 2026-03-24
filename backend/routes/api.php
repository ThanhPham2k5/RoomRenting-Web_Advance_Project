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
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AddressController;

/* API routes for Account_User 
    - AccountController
    - EmployeeController
    - PersonalInfoController
*/

//Account
Route::middleware(['auth:sanctum', 'permission:account.get'])
    ->get('/accounts/{account}', [AccountController::class, 'show']);

Route::middleware(['auth:sanctum', 'permission:account.getAll'])
    ->get('/accounts', [AccountController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:account.create'])
    ->post('/accounts', [AccountController::class, 'store']);

Route::middleware(['auth:sanctum', 'permission:account.update'])
    ->put('/accounts/{account}', [AccountController::class, 'update']);

Route::middleware(['auth:sanctum', 'permission:account.delete'])
    ->delete('/accounts/{account}', [AccountController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:account.restore'])
    ->post('/accounts/{account}/restore', [AccountController::class, 'restore'])
    ->withTrashed();


// Assignments
Route::middleware(['auth:sanctum', 'permission:account.assignRoles'])
    ->post('/accounts/{account}/assign-roles', [AccountController::class, 'assignRoles']);

Route::middleware(['auth:sanctum', 'permission:account.syncRoles'])
    ->post('/accounts/{account}/sync-roles', [AccountController::class, 'syncRoles']);

Route::middleware(['auth:sanctum', 'permission:account.assignPermissions'])
    ->post('/accounts/{account}/assign-permissions', [AccountController::class, 'assignPermissions']);

    
//User
Route::middleware(['auth:sanctum', 'permission:user.get'])
    ->get('/users/{user}', [UserController::class, 'show']);


Route::middleware(['auth:sanctum', 'permission:user.getAll'])
    ->get('/users', [UserController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:user.update'])
    ->put('/users', [UserController::class, 'update']);


//Employee
Route::middleware(['auth:sanctum', 'permission:employee.get'])
    ->get('/employees/{employee}', [EmployeeController::class, 'show']);

    
Route::middleware(['auth:sanctum', 'permission:employee.getAll'])
    ->get('/employees', [EmployeeController::class, 'index']);  


//PersonalInfo
Route::middleware(['auth:sanctum', 'permission:personalInfo.get'])
    ->get('/personalInfos/{personalInfo}', [PersonalInfoController::class, 'show']);

Route::middleware(['auth:sanctum', 'permission:personalInfo.getAll'])
    ->get('/personalInfos', [PersonalInfoController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:personalInfo.update'])
    ->put('/personalInfos/{personalInfo}', [PersonalInfoController::class, 'update']);

    

/* API routes for Posts 
    - CommentController
    - PostController
    - PostImageController
    - FavoriteController
*/


//Post
Route::middleware(['auth:sanctum','permission:post.get'])
    ->get('/posts/{post}', [PostController::class, 'show']);

Route::middleware(['auth:sanctum','permission:post.getAll'])
    ->get('/posts', [PostController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:post.create'])
    ->post('/posts', [PostController::class, 'store']);

Route::middleware(['auth:sanctum', 'permission:post.update'])
    ->put('/posts/{post}', [PostController::class, 'update']);

Route::middleware(['auth:sanctum', 'permission:post.delete'])
    ->delete('/posts/{post}', [PostController::class, 'destroy']);
    
Route::middleware(['auth:sanctum', 'permission:post.restore'])
    ->post('/posts/{post}/restore', [PostController::class, 'restore'])
    ->withTrashed();

//Comment
Route::middleware(['auth:sanctum','permission:comment.get'])
    ->get('/comments/{comment}', [CommentController::class, 'show']);

Route::middleware(['auth:sanctum','permission:comment.getAll'])
    ->get('/comments', [CommentController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:comment.create'])
    ->post('/comments', [CommentController::class, 'store']);

Route::middleware(['auth:sanctum', 'permission:comment.update'])
    ->put('/comments/{comment}', [CommentController::class, 'update']);

Route::middleware(['auth:sanctum', 'permission:comment.delete'])
    ->delete('/comments/{comment}', [CommentController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:comment.restore'])
    ->post('/comments/{comment}/restore', [CommentController::class, 'restore'])
    ->withTrashed();

//Favorite
Route::middleware(['auth:sanctum','permission:favorite.get'])
    ->get('/favorites/{favorite}', [FavoriteController::class, 'show']);

Route::middleware(['auth:sanctum','permission:favorite.getAll'])
    ->get('/favorites', [FavoriteController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:favorite.create'])
    ->post('/favorites', [FavoriteController::class, 'store']);

Route::middleware(['auth:sanctum', 'permission:favorite.update'])
    ->put('/favorites/{favorite}', [FavoriteController::class, 'update']);

Route::middleware(['auth:sanctum', 'permission:favorite.delete'])
    ->delete('/favorites/{favorite}', [FavoriteController::class, 'destroy']);


/* API routes for Form 
    - FormController
*/
//Form
Route::middleware(['auth:sanctum', 'permission:form.get'])
    ->get('/forms/{form}', [FormController::class, 'show']);

Route::middleware(['auth:sanctum', 'permission:form.getAll'])
    ->get('/forms', [FormController::class, 'index']);

Route::middleware(['auth:sanctum', 'permission:form.update'])
    ->put('/forms/{form}', [FormController::class, 'update']);

Route::middleware(['auth:sanctum', 'permission:form.getRecommendation'])
    ->get('/forms/recommendations', [FormController::class, 'getRecommendedPosts']);



/* API routes for Notification 
    - NotificationController
    - markAsRead method for NotificationController
*/
//Notification
Route::middleware(['auth:sanctum', 'permission:notification.get'])
->get('/notifications/{notification}', [NotificationController::class, 'show']);

    
Route::middleware(['auth:sanctum', 'permission:notification.getAll'])
->get('/notifications', [NotificationController::class, 'index']);


Route::middleware(['auth:sanctum', 'permission:notification.create'])
->post('/notifications', [NotificationController::class, 'store']);


Route::middleware(['auth:sanctum', 'permission:notification.update'])
->put('/notifications/{notification}', [NotificationController::class, 'update']);


Route::middleware(['auth:sanctum', 'permission:notification.delete'])
->delete('/notifications/{notification}', [NotificationController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:notification.restore'])
    ->post('/notifications/{notification}/restore', [NotificationController::class, 'restore'])
    ->withTrashed();


/* API routes for Payments 
    - PayBillController
    - PayRuleController
    - RechargeBillController
    - RechargeRuleController
*/
//PayBill
Route::middleware(['auth:sanctum', 'permission:payBill.get'])
->get('/payBills/{payBill}', [PayBillController::class, 'show']);

    
Route::middleware(['auth:sanctum', 'permission:payBill.getAll'])
->get('/payBills', [PayBillController::class, 'index']);


Route::middleware(['auth:sanctum', 'permission:payBill.create'])
->post('/payBills', [PayBillController::class, 'store']);


Route::middleware(['auth:sanctum', 'permission:payBill.update'])
->put('/payBills/{payBill}', [PayBillController::class, 'update']);


Route::middleware(['auth:sanctum', 'permission:payBill.delete'])
->delete('/payBills/{payBill}', [PayBillController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:payBill.restore'])
    ->post('/payBills/{payBill}/restore', [PayBillController::class, 'restore'])
    ->withTrashed();


//PayRule
Route::middleware(['auth:sanctum', 'permission:payRule.get'])
->get('/payRules/{payRule}', [PayRuleController::class, 'show']);

    
Route::middleware(['auth:sanctum', 'permission:payRule.getAll'])
->get('/payRules', [PayRuleController::class, 'index']);


Route::middleware(['auth:sanctum', 'permission:payRule.create'])
->post('/payRules', [PayRuleController::class, 'store']);


Route::middleware(['auth:sanctum', 'permission:payRule.update'])
->put('/payRules/{payRule}', [PayRuleController::class, 'update']);


Route::middleware(['auth:sanctum', 'permission:payRule.delete'])
->delete('/payRules/{payRule}', [PayRuleController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:payRule.restore'])
    ->post('/payRules/{payRule}/restore', [PayRuleController::class, 'restore'])
    ->withTrashed();


//RechargeBill
Route::middleware(['auth:sanctum', 'permission:rechargeBill.get'])
->get('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'show']);

    
Route::middleware(['auth:sanctum', 'permission:rechargeBill.getAll'])
->get('/rechargeBills', [RechargeBillController::class, 'index']);


Route::middleware(['auth:sanctum', 'permission:rechargeBill.create'])
->post('/rechargeBills', [RechargeBillController::class, 'store']);


Route::middleware(['auth:sanctum', 'permission:rechargeBill.update'])
->put('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'update']);


Route::middleware(['auth:sanctum', 'permission:rechargeBill.delete'])
->delete('/rechargeBills/{rechargeBill}', [RechargeBillController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:rechargeBill.restore'])
    ->post('/rechargeBills/{rechargeBill}/restore', [RechargeBillController::class, 'restore'])
    ->withTrashed();


//RechargeRule
Route::middleware(['auth:sanctum', 'permission:rechargeRule.get'])
->get('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'show']);

    
Route::middleware(['auth:sanctum', 'permission:rechargeRule.getAll'])
->get('/rechargeRules', [RechargeRuleController::class, 'index']);


Route::middleware(['auth:sanctum', 'permission:rechargeRule.create'])
->post('/rechargeRules', [RechargeRuleController::class, 'store']);


Route::middleware(['auth:sanctum', 'permission:rechargeRule.update'])
->put('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'update']);


Route::middleware(['auth:sanctum', 'permission:rechargeRule.delete'])
->delete('/rechargeRules/{rechargeRule}', [RechargeRuleController::class, 'destroy']);

Route::middleware(['auth:sanctum', 'permission:rechargeRule.restore'])
    ->post('/rechargeRules/{rechargeRule}/restore', [RechargeRuleController::class, 'restore'])
    ->withTrashed();

/* API routes for Auth 
    - AuthController
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

/* API routes for Roles and Permissions 
    - RoleController
    - PermissionController
*/
// Roles
Route::middleware(['auth:sanctum'])
    ->apiResource('roles', RoleController::class);

Route::middleware(['auth:sanctum'])
    ->post('/roles/{role}/assign-permissions', [RoleController::class, 'assignPermissionsToRole']);


// Permissions
Route::middleware(['auth:sanctum'])
    ->apiResource('permissions', PermissionController::class);


/* API routes for Address 
    - AddressController
*/

Route::get('/address/provinces', [AddressController::class, 'getProvinces']);
Route::get('/address/provinces/{code}', [AddressController::class, 'getProvinceByCode']);
Route::get('/address/provinces/{code}/wards', [AddressController::class, 'getWardsFromProvinceCode']);

Route::get('/address/wards', [AddressController::class, 'getWards']);
Route::get('/address/wards/{code}', [AddressController::class, 'getWardByCode']);
