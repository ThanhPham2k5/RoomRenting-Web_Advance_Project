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

    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|min:3|max:30',
            'password' => 'required|string|min:8|max:255',
        ]);

        $account = Account::where('username', $fields['username'])->first();

        if (!$account || !Hash::check($fields['password'], $account->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        $existedToken = PersonalAccessToken::where('tokenable_id', $account->id)->first();
        if(!$existedToken){
            $token = $account->createToken($fields['username']);

            return response()->json([
                'account' => $account,
                'token' => $token->plainTextToken,
            ]);
        }else{
            return response()->json([
                'message' => 'account has already logged in'
            ]);
        }
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

}
