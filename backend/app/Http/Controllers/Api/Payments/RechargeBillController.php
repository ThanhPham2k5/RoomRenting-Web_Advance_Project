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

class RechargeBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new RechargeBillFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0){
            return new RechargeBillCollection(RechargeBill::paginate());
        }
        $RechargeBills = RechargeBill::where($queryItems)->paginate();
        return new RechargeBillCollection($RechargeBills->appends($request->query()));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RechargeBill $rechargeBill)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RechargeBill $rechargeBill)
    {
        //
    }
}
