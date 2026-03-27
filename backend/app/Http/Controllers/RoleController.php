<?php

namespace App\Http\Controllers;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class RoleController extends Controller
{
    private $allowedIncludes = [
        'permissions',
    ];

    private $allowSorts = [
        'id',
    ];

    private $allColFilter = [
        'name',
    ];

    public function index()
    {
        $query = QueryBuilder::for(Role::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::partial('name'),
            AllowedFilter::exact('id'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts($this->allowSorts);

        $roles = $query->get();

        return new RoleCollection($roles);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' => 'nullable|string'
        ]);

        $role = Role::create($validate);

        return response()->json([
            'message' => 'Role created successfully',
            'role' => $role
        ], 201);
    }

    public function show(Role $role)
    {
        $role = QueryBuilder::for(Role::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($role->id);

        return new RoleResource($role);
    }

    public function update(Request $request, Role $role)
    {
        $validate = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'description' => 'sometimes|string'
        ]);

        $role->update($validate);

        return response()->json([
            'message' => 'Role updated successfully',
            'role' => $role
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
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
}
