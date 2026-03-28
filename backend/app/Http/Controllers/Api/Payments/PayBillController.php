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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PayBillController extends Controller
{
    use AuthorizesRequests;
    private $allowedIncludes = [
        'account',
        'payRule',
        'post',
        'notifications'
    ];

    private $allColFilter = [
        'status'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', PayBill::class);

        $query = QueryBuilder::for(PayBill::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'points',
        ]);

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

        // $validated = $request->validated();
        
        // $payBill = PayBill::create($validated);

        // event(new PayBillCreated($payBill));

        // return response()->json([
        //     'message' => 'Pay bill created successfully',
        //     'payBill' => new PayBillResource($payBill)
        // ], 201);
        return response()->json([
            'message' => 'Pay bill auto create, no need to create manually',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PayBill $payBill)
    {
        $this->authorize('view', $payBill);

        $payBill = QueryBuilder::for(PayBill::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($payBill->id);

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
        
        $payBill->update($validated);

        return response()->json([
            'message' => 'Pay bill updated successfully',
            'payBill' => new PayBillResource($payBill)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayBill $payBill)
    {
        $payBill->delete();

        return response()->json([
            'message' => 'Pay bill deleted successfully'
        ]);
    }


    public function restore($id) {

        $payBill = PayBill::onlyTrashed()->findOrFail($id);

        $payBill->restore();

        return response()->json([
            'message' => 'PayBill restored successfully'
        ]);
    }
}
