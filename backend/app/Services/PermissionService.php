<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionService{
    private $allowedIncludes = [
        'roles',
        'account'
    ];

    private $allColFilter = [
        'name',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Permission::class)
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

    public function getPermission($permission){
        $permission = QueryBuilder::for(Permission::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($permission->id);

        return $permission;
    }
}
?>