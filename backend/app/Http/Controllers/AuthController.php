<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Account_User\AccountController;
use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'username' => 'required|string|min:3|max:30|unique:accounts,username',
            'password' => 'required|string|min:8|max:255',
            'email' => 'required|email|unique:personal_infos,email',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(03|05|07|08|09)[0-9]{8}$/'
            ]
        ]);

        // Create PersonalInfo
        $personalInfo = PersonalInfo::create([
            'email' => $fields['email'],
            'phone_number' => $fields['phone_number'],
        ]);

        // Create Account
        $account = Account::create([
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
            'role' => 'user',
        ]);

        // Create User
        $user = User::create([
            'points' => 0,
            'account_id' => $account->id,
            'personal_info_id' => $personalInfo->id,
        ]);

        // Create token
        $token = $account->createToken($fields['username']);

        return response()->json([
            'account' => $account,
            'user' => $user,
            'personalInfo' => $personalInfo,
            'token' => $token->plainTextToken,
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
