<?php

namespace App\Http\Controllers\Api\Payments;

use App\Filter\PayBillFilter;
use App\Models\Payments\PayBill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayBillRequest;
use App\Http\Requests\UpdatePayBillRequest;
use App\Http\Resources\Payments\PayBillCollection;
use App\Http\Resources\Payments\PayBillResource;
use Illuminate\Http\Request;

class PayBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PayBillFilter();

        $query = PayBill::query();

        $query = $filter->transform($request, $query);

        return new PayBillCollection(
            $query->paginate()->appends($request->query())
        );
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
        $validated = $request->validated();
        
        $payBill = PayBill::create($validated);

        return response()->json([
            'message' => 'Pay bill created successfully',
            'payBill' => new PayBillResource($payBill)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PayBill $payBill)
    {
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
}
