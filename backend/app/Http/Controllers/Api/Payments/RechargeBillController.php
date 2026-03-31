<?php

namespace App\Http\Controllers\Api\Payments;

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
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Account_User\Account;
use App\Models\Account_User\User;
use App\Services\RechargeBillService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RechargeBillController extends Controller
{
    use AuthorizesRequests;
    
    private RechargeBillService $rechargeService;

    public function __construct(RechargeBillService $rechargeService)
    {
        $this->rechargeService = $rechargeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', RechargeBill::class);

        $query = $this->rechargeService->buildGetAllQuery();

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
        
        $result = $this->rechargeService->createRechargeBill($validated);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(RechargeBill $rechargeBill)
    {
        $this->authorize('view', $rechargeBill);

        $rechargeBill = $this->rechargeService->getRechargeBill($rechargeBill);

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
        
        $result = $this->rechargeService->updateRechargeBill($rechargeBill, $validated);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RechargeBill $rechargeBill)
    {
        $result = $this->rechargeService->deleteRechargeBill($rechargeBill);

        return response()->json($result);
    }

    public function restore($id) {

        $result = $this->rechargeService->restoreRechargeBill($id);

        return response()->json($result);
    }
}
