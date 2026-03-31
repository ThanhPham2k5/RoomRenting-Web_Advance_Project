<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Account_User\UserCollection;
use App\Http\Resources\Account_User\UserResource;
use App\Models\Account_User\Account;
use App\Models\Account_User\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    use AuthorizesRequests;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->userService->buildGetAllQuery();

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
        $user = $this->userService->getUser($user);

        return new UserResource($user);
    }

    public function showByAccountId(Account $account)
    {
        $user = $account->user;
        
        $user = $this->userService->getUser($user);

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
        
        $result = $this->userService->updateUser($user, $validated);

        return response()->json($result);
    }

    public function updateByAccountId(UpdateUserRequest $request, Account $account)
    {
        $user = $account->user;

        $this->authorize('update', $user);

        $validated = $request->validated();

        $result = $this->userService->updateUser($user, $validated);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
