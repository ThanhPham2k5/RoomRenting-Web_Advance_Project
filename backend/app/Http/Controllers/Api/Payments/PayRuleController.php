<?php

namespace App\Http\Controllers\Api\Payments;

use App\Filter\PayRuleFilter;
use App\Models\Payments\PayRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayRuleRequest;
use App\Http\Requests\UpdatePayRuleRequest;
use App\Http\Resources\Payments\PayRuleCollection;
use App\Http\Resources\Payments\PayRuleResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PayRuleController extends Controller
{
    private $allowedIncludes = [
        'payBills',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $PayRules = QueryBuilder::for(PayRule::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            'points',
        ])
        ->paginate()
        ->appends($request->query());

        return new PayRuleCollection($PayRules);
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
    public function store(StorePayRuleRequest $request)
    {
        $validated = $request->validated();
        
        $payRule = PayRule::create($validated);

        return response()->json([
            'message' => 'Pay rule created successfully',
            'payRule' => new PayRuleResource($payRule)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PayRule $payRule)
    {
        $payRule = QueryBuilder::for(PayRule::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($payRule->id);

        return new PayRuleResource($payRule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayRule $payRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayRuleRequest $request, PayRule $payRule)
    {
        $validated = $request->validated();
        
        $payRule->update($validated);

        return response()->json([
            'message' => 'Pay rule updated successfully',
            'payRule' => new PayRuleResource($payRule)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayRule $payRule)
    {
        $payRule->delete();

        return response()->json([
            'message' => 'Pay rule deleted successfully'
        ]);
    }
}
