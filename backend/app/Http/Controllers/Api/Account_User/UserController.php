<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Account_User\UserCollection;
use App\Http\Resources\Account_User\UserResource;
use App\Models\Account_User\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    private $allowedIncludes = [
        'account',
        'personalInfo',
        'posts',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Users = QueryBuilder::for(User::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            'points',
        ])
        ->paginate()
        ->appends($request->query());

        return new UserCollection($Users);
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
        $user = QueryBuilder::for(User::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($user->id);

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
