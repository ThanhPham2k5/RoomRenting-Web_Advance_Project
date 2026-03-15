<?php

namespace App\Http\Controllers;

use App\Models\Account_User\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $account = Account::where('username', $fields['username'])->first();

        if (!$account || !Hash::check($fields['password'], $account->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $account->createToken($fields['username']);

        return response()->json([
            'account' => $account,
            'token' => $token->plainTextToken,
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

}
