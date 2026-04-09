<?php

namespace App\Http\Controllers;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class RoleController extends Controller
{
    
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $query = $this->roleService->buildGetAllQuery();

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $roles = $query->get();
        } else {
            $roles = $query->paginate((int) $perPage)
                ->appends($request->query());
        }
        
        return new RoleCollection($roles);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'guard_name' => 'sometimes|string',
            'description' => 'nullable|string',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $result = $this->roleService->createRole($validate);

        return response()->json($result);
    }

    public function show(Role $role)
    {
        $role = $this->roleService->getRole($role);

        return new RoleResource($role);
    }

    public function update(Request $request, Role $role)
    {
        $validate = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'guard_name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $result = $this->roleService->updateRole($role, $validate);

        return response()->json($result);
    }

    public function destroy(Role $role)
    {
        if($role->name === 'admin')
            return response()->json([
                'message' => 'Không thể xóa vai trò này.'
            ]);
        $result = $this->roleService->deleteRole($role);

        return response()->json($result);
    }

    public function assignPermissionsToRole(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role->givePermissionTo($request->permissions);

        return response()->json([
            'message' => 'Permissions assigned to role'
        ]);
    }

    public function revokePermissionsFromRole(Request $request, Role $role)
    {
        if($role->name === 'admin')
            return response()->json([
                'message' => 'Không thể tước quyền khỏi vai trò này.'
            ]);
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role->revokePermissionTo($request->permissions);

        return response()->json([
            'message' => 'Permissions revoked from role'
        ]);
    }
}
