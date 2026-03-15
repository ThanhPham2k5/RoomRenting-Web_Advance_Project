<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\AccountFilter;
use App\Models\Account_User\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\Account_User\AccountCollection;
use App\Http\Resources\Account_User\AccountResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AccountFilter();

        $query = Account::query();

        $query = $filter->transform($request, $query);

        return new AccountCollection(
            $query->paginate()->appends($request->query())
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $validated = $request->validated();
        
        $account = Account::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        $token = $account->createToken($validated['username']);

        return response()->json([
            'account' => new AccountResource($account),
            'token' => $token->plainTextToken
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return new AccountResource($account);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
    }
}
