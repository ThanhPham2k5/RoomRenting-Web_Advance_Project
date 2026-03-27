<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Account_User\UserCollection;
use App\Http\Resources\Account_User\UserResource;
use App\Models\Account_User\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    use AuthorizesRequests;

    private $allowedIncludes = [
        'account',
        'personalInfo',
        'posts',
    ];

    private $allColFilter = [
        'points',
        'account.username',
        'account.role',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(User::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('account.username'),
            AllowedFilter::exact('account.role'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'points',
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Users = $query->get();
        } else {
            $Users = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

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
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        $user->update($validated);
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
