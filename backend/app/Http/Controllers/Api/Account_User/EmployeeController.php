<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Account_User\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\Account_User\EmployeeCollection;
use App\Http\Resources\Account_User\EmployeeResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    private $allowedIncludes = [
        'account',
        'personalInfo',
        'posts',
    ];

    private $allColFilter = [
        'account.username',
        'account.role'
    ];

    private $allowSorts = [
        'id',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        ->allowedSorts($this->allowSorts);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Employees = $query->get();
        } else {
            $Employees = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new EmployeeCollection($Employees);
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
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee = QueryBuilder::for(Employee::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($employee->id);

        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
