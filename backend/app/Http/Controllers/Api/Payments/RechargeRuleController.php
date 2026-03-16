<?php

namespace App\Http\Controllers\Api\Payments;

use App\Filter\RechargeRuleFilter;
use App\Models\Payments\RechargeRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRechargeRuleRequest;
use App\Http\Requests\UpdateRechargeRuleRequest;
use App\Http\Resources\Payments\RechargeRuleCollection;
use App\Http\Resources\Payments\RechargeRuleResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class RechargeRuleController extends Controller
{

    private $allowedIncludes = [
        'rechargeBills',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $RechargeRules = QueryBuilder::for(RechargeRule::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('money', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            'points',
        ])
        ->paginate()
        ->appends($request->query());

        return new RechargeRuleCollection($RechargeRules);
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
    public function store(StoreRechargeRuleRequest $request)
    {
        $validated = $request->validated();
        
        $rechargeRule = RechargeRule::create($validated);

        return response()->json([
            'message' => 'Recharge rule created successfully',
            'rechargeRule' => new RechargeRuleResource($rechargeRule)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RechargeRule $rechargeRule)
    {
        $rechargeRule = QueryBuilder::for(RechargeRule::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($rechargeRule->id);

        return new RechargeRuleResource($rechargeRule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RechargeRule $rechargeRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRechargeRuleRequest $request, RechargeRule $rechargeRule)
    {
        $validated = $request->validated();
        
        $rechargeRule->update($validated);

        return response()->json([
            'message' => 'Recharge rule updated successfully',
            'rechargeRule' => new RechargeRuleResource($rechargeRule)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RechargeRule $rechargeRule)
    {
        $rechargeRule->delete();

        return response()->json([
            'message' => 'Recharge rule deleted successfully'
        ]);
    }
}
