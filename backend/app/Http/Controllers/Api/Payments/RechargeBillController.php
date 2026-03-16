<?php

namespace App\Http\Controllers\Api\Payments;

use App\Filter\RechargeBillFilter;
use App\Models\Payments\RechargeBill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRechargeBillRequest;
use App\Http\Requests\UpdateRechargeBillRequest;
use App\Http\Resources\Payments\RechargeBillCollection;
use App\Http\Resources\Payments\RechargeBillResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class RechargeBillController extends Controller
{

    private $allowedIncludes = [
        'account',
        'rechargeRule',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $RechargeBills = QueryBuilder::for(RechargeBill::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('money', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('totalMoney', FilterOperator::DYNAMIC, '', 'total_money'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('vat', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('status', FilterOperator::DYNAMIC), // =, <>
        ])
        ->allowedSorts([
            'id',
            'money',
            AllowedSort::field('totalMoney', 'total_money')
        ])
        ->paginate()
        ->appends($request->query());

        return new RechargeBillCollection($RechargeBills);
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
    public function store(StoreRechargeBillRequest $request)
    {
        $validated = $request->validated();
        
        $rechargeBill = RechargeBill::create($validated);

        return response()->json([
            'message' => 'Recharge bill created successfully',
            'rechargeBill' => new RechargeBillResource($rechargeBill)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RechargeBill $rechargeBill)
    {
        $rechargeBill = QueryBuilder::for(RechargeBill::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($rechargeBill->id);

        return new RechargeBillResource($rechargeBill);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RechargeBill $rechargeBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRechargeBillRequest $request, RechargeBill $rechargeBill)
    {
        $validated = $request->validated();
        
        $rechargeBill->update($validated);

        return response()->json([
            'message' => 'Recharge bill updated successfully',
            'rechargeBill' => new RechargeBillResource($rechargeBill)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RechargeBill $rechargeBill)
    {
        $rechargeBill->delete();

        return response()->json([
            'message' => 'Recharge bill deleted successfully'
        ]);
    }
}
