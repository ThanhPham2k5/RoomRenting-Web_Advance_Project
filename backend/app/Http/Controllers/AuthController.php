<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account_User\Account;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    
    public function register(StoreAccountRequest $request){
        $validated = $request->validated();

        $result = $this->accountService->createAccount($validated);

        if($result['account']){
            $response = 'registeration success!';
        }else{
             $response = 'registeration fail!';
        }

        return response()->json([
            $response
        ], 201);
    }

    public function loginUser(Request $request)
    {
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string|min:8|max:255',
        ]);

        $account = $this->getAccount($fields);

        if($account && $account->employee){
            return response()->json(['message' => 'Employee account cannot login here'], 403);
        }

        //check if account is deleted or not
        if ($account && $account->deleted_at) {
            return response()->json(['message' => 'Tài khoản đã bị khóa.'], 403);
        }

        if (!$account || !Hash::check($fields['password'], $account->password)) {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng.'], 401);
        }

        $token = $this->createToken($account, $fields);

        return response()->json([
            'account' => $account,
            'token' => $token,
        ]);
    }

    public function loginEmployee(Request $request)
    {
        $fields = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string|min:8|max:255',
        ]);

        $account = $this->getAccount($fields);

        if($account && $account->user){
            return response()->json(['message' => 'User account cannot login here'], 403);
        }

        //check if account is deleted or not
        if ($account && $account->deleted_at) {
            return response()->json(['message' => 'Tài khoản đã bị khóa'], 403);
        }

        if (!$account || !Hash::check($fields['password'], $account->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $this->createToken($account, $fields);

        return response()->json([
            'account' => $account,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        // Check if the token was successfully deleted
        if (!$request->user()->currentAccessToken()) {
            return response()->json(['message' => 'Failed to log out'], 500);
        }

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function ForgotPassword(Request $request)
    {
        // Implement forgot password logic here
    }

    public function getAccount($fields)
    {
        $loginValue = $fields['login'];

        $account = Account::withTrashed()->where(function ($query) use ($loginValue) {
            $query->where('username', $loginValue)
                  ->orWhereHas('user', function ($query) use ($loginValue) {
                      $query->whereHas('personalInfo', function ($query) use ($loginValue) {
                          $query->where('email', $loginValue)
                                ->orWhere('phone_number', $loginValue);
                      });
                  })
                  ->orWhereHas('employee', function ($query) use ($loginValue) {
                      $query->whereHas('personalInfo', function ($query) use ($loginValue) {
                          $query->where('email', $loginValue)
                                ->orWhere('phone_number', $loginValue);
                      });
                  });
        })->first();

        return $account;
    }

    public function createToken($account){
        
        $existedToken = PersonalAccessToken::where('tokenable_id', $account->id)->first();
        if(!$existedToken){
            $token = $account->createToken($account->username . '_token');
        }else{
            // replace old token with new one
            $existedToken->delete();
            $token = $account->createToken($account->username . '_token');
        }

        return $token->plainTextToken;
    }

}
