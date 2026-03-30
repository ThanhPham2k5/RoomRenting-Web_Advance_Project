<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Account_User\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\Account_User\AccountCollection;
use App\Http\Resources\Account_User\AccountResource;
use App\Services\AccountService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedSort;

class AccountController extends Controller
{   
    use AuthorizesRequests;

    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->accountService->buildGetAllQuery();

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $accounts = $query->get();
        } else {
            $accounts = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

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
        $validated = $request->validated();
        
        $result = $this->accountService->createAccount($validated);

        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        $account = $this->accountService->getAccount($account);
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
        $this->authorize('update', $account);

        $validated = $request->validated();

        $result = $this->accountService->updateAccount($account, $validated);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        if($account->hasRole('admin'))
            return response()->json([
                'message' => 'Cannot delete this account'
            ]);
        $this->authorize('delete', $account);

        $result = $this->accountService->deleteAccount($account);

        return response()->json($result);
    }

    public function restore($id) {
        $account = Account::onlyTrashed()->findOrFail($id);
        $result = $this->accountService->restoreAccount($account);

        return response()->json($result);
    }

    public function assignRoles(Request $request, Account $account)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $account->assignRole($request->roles);
        
        return response()->json([
            'message' => 'Roles assigned'
        ]);
    }

    public function syncRoles(Request $request, Account $account)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $account->syncRoles($request->roles);

        return response()->json([
            'message' => 'Roles synced'
        ]);
    }

    public function assignPermissions(Request $request, Account $account)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $account->givePermissionTo($request->permissions);

        return response()->json([
            'message' => 'Permissions assigned'
        ]);
    }
}
