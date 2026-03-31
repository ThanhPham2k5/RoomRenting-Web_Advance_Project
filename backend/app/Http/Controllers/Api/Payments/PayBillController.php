<?php

namespace App\Http\Controllers\Api\Payments;

use App\Models\Payments\PayBill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayBillRequest;
use App\Http\Requests\UpdatePayBillRequest;
use App\Http\Resources\Payments\PayBillCollection;
use App\Http\Resources\Payments\PayBillResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use App\Events\PayBillCreated;
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Services\PayBillService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\QueryBuilder\AllowedSort;

class PayBillController extends Controller
{
    use AuthorizesRequests;
    
    private PayBillService $payBillService;

    public function __construct(PayBillService $payBillService)
    {
        $this->payBillService = $payBillService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', PayBill::class);

        $query = $this->payBillService->buildGetAllQuery();

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $PayBills = $query->get();
        } else {
            $PayBills = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new PayBillCollection($PayBills);
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
    public function store(StorePayBillRequest $request)
    {
        // The payment for the post will be handled by a scheduled job, so we don't need to create a pay bill here
    }

    /**
     * Display the specified resource.
     */
    public function show(PayBill $payBill)
    {
        $this->authorize('view', $payBill);

        $payBill = $this->payBillService->getPayBill($payBill);

        return new PayBillResource($payBill);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayBill $payBill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayBillRequest $request, PayBill $payBill)
    {
        $validated = $request->validated();
        
        $result = $this->payBillService->updatePayBill($payBill, $validated);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayBill $payBill)
    {
        $result = $this->payBillService->deletePayBill($payBill);

        return response()->json($result);
    }


    public function restore($id) {

        $result = $this->payBillService->restorePayBill($id);

        return response()->json($result);
    }
}
