<?php

namespace App\Http\Controllers\Api\Payments;

use App\Models\Payments\PayBill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayBillRequest;
use App\Http\Requests\UpdatePayBillRequest;
use App\Http\Resources\Payments\PayBillCollection;
use App\Http\Resources\Payments\PayBillResource;

class PayBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PayBillCollection(PayBill::all());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayBill $payBill)
    {
        //
    }
}
