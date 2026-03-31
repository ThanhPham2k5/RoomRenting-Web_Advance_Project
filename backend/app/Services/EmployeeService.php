<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Account_User\Employee;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeService{
    private $allowedIncludes = [
        'account',
        'personalInfo',
        'posts',
    ];

    private $allColFilter = [
        'account.username',
        'account.role'
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Employee::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::partial('account.username'),
            AllowedFilter::exact('account.role'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getEmployee($employee){
        $employee = QueryBuilder::for(Employee::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($employee->id);

        return $employee;
    }
}
?>