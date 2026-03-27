<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionController extends Controller
{
    private $allowedIncludes = [
        'roles',
    ];

    private $allowSorts = [
        'id',
    ];

    public function index()
    {
        $query = QueryBuilder::for(Permission::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::partial('name'),
            AllowedFilter::exact('id'),
        ])
        ->allowedSorts($this->allowSorts);

        $roles = $query->get();

        return new PermissionCollection($roles);
    }

    public function show(Permission $permission)
    {
        $permission = QueryBuilder::for(Permission::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($permission->id);

        return new PermissionResource($permission);
    }
}
