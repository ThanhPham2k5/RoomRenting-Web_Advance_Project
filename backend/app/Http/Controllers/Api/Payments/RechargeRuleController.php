<?php

namespace App\Http\Controllers\Api\Payments;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Payments\RechargeRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRechargeRuleRequest;
use App\Http\Requests\UpdateRechargeRuleRequest;
use App\Http\Resources\Payments\RechargeRuleCollection;
use App\Http\Resources\Payments\RechargeRuleResource;
use App\Services\RechargeRuleService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\QueryBuilder\AllowedSort;

class RechargeRuleController extends Controller
{
    use AuthorizesRequests;    
    
    private RechargeRuleService $rechargeRuleService;

    public function __construct(RechargeRuleService $rechargeRuleService)
    {
        $this->rechargeRuleService = $rechargeRuleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->rechargeRuleService->buildGetAllQuery();

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $RechargeRules = $query->get();
        } else {
            $RechargeRules = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

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

        $result = $this->rechargeRuleService->createRechargeRule($validated);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(RechargeRule $rechargeRule)
    {
        $rechargeRule = $this->rechargeRuleService->getRechargeRule($rechargeRule);

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
        // $validated = $request->validated();
        // if (isset($validated['status']) && $validated['status'] === 'active') {
        //     // Deactivate all other recharge rules
        //     RechargeRule::where('id', '!=', $rechargeRule->id)->update(['status' => 'inactive']);

        //     $rechargeRule->update($validated);
        // }

        // return response()->json([
        //     'message' => 'Recharge rule updated successfully',
        //     'rechargeRule' => new RechargeRuleResource($rechargeRule)
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RechargeRule $rechargeRule)
    {
        // if ($rechargeRule->status === 'active') {
        //     return response()->json([
        //     'message' => 'Cannot delete while in active status'
        // ]);
        // }
        // $rechargeRule['status'] = 'inactive';
        // $rechargeRule->delete();

        // return response()->json([
        //     'message' => 'Recharge rule deleted successfully'
        // ]);
    }

    public function restore($id) {

        $result = $this->rechargeRuleService->restoreRechargeRule($id);

        return response()->json($result);
    }
}
