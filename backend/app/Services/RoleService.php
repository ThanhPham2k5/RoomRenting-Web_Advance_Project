<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class RoleService{
    private $allowedIncludes = [
        'permissions',
        'accounts'
    ];

    private $allColFilter = [
        'name',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Role::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::partial('name'),
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('createdAt', 'created_at'),
            AllowedSort::field('updateAt', 'updated_at'),
        ]);

        return $query;
    }

    public function getRole($role){
        $role = QueryBuilder::for(Role::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($role->id);

        return $role;
    }

    public function createRole($data){
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web',
            'description' => $data['description'] ?? null,
        ]);

        if (isset($data['permissions'])) {
            $role->givePermissionTo($data['permissions']);
        }

        return [
            'message' => 'Role created successfully',
            'role' => $role
        ];
    }

    public function updateRole($role, $data){
        $role->update([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? $role->guard_name,
            'description' => $data['description'] ?? $role->description,
        ]);

        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return [
            'message' => 'Role updated successfully',
            'role' => $role
        ];
    }

    public function deleteRole($role){
        $role->delete();

        return [
            'message' => 'Role deleted successfully'
        ];
    }
}
?>