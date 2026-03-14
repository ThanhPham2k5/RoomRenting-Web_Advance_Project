<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Account_User\UserCollection;
use App\Http\Resources\Account_User\UserResource;
use App\Models\Account_User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UserFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0){
            return new UserCollection(User::paginate());
        }
        $Users = User::where($queryItems)->paginate();
        return new UserCollection($Users->appends($request->query()));
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
    // public function store(StoreAccountRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateAccountRequest $request, User $user)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
