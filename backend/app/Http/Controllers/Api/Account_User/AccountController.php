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
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class AccountController extends Controller
{

    private $allowedIncludes = [
        'form',
        'user',
        'employee',
        'user.posts',
        'employee.posts',
        'comments',
        'favorites.post',
        'rechargeBills',
        'payBills'
    ];

    private $allowSorts = [
        'id',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accounts = QueryBuilder::for(Account::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::partial('username'),
            AllowedFilter::exact('id'),

            AllowedFilter::operator('role', FilterOperator::DYNAMIC) // =, <>
        ])
        ->allowedSorts($this->allowSorts)
        ->paginate()
        ->appends($request->query());

        return new AccountCollection($accounts);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        $account = QueryBuilder::for(Account::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($account->id);

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
