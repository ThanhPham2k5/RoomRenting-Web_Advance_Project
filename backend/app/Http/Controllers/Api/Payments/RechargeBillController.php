<?php

namespace App\Http\Controllers\Api\Payments;

use App\Filter\RechargeBillFilter;
use App\Models\Payments\RechargeBill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRechargeBillRequest;
use App\Http\Requests\UpdateRechargeBillRequest;
use App\Http\Resources\Payments\RechargeBillCollection;
use App\Http\Resources\Payments\RechargeBillResource;
use App\Models\Payments\RechargeRule;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use App\Events\RechargeBillCreated;
use App\Models\Account_User\Account;
use App\Models\Account_User\User;

class RechargeBillController extends Controller
{

    private $allowedIncludes = [
        'account',
        'rechargeRule',
        'notifications'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(RechargeBill::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('money', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('totalMoney', FilterOperator::DYNAMIC, '', 'total_money'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('vat', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
        ])
        ->allowedSorts([
            'id',
            'money',
            AllowedSort::field('totalMoney', 'total_money')
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $RechargeBills = $query->get();
        } else {
            $RechargeBills = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

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

        // Increment user points
        $point = $rechargeBill->rechargeRule->points;
        $user = User::where('id', $rechargeBill->account->user_id)->first();
        $user->increment('points', $point);
        
        event(new RechargeBillCreated($rechargeBill));

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
