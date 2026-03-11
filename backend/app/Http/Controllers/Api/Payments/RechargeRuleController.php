<?php

namespace App\Http\Controllers\Api\Payments;

use App\Models\Payments\RechargeRule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRechargeRuleRequest;
use App\Http\Requests\UpdateRechargeRuleRequest;
use App\Http\Resources\Payments\RechargeRuleCollection;
use App\Http\Resources\Payments\RechargeRuleResource;

class RechargeRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new RechargeRuleCollection(RechargeRule::all());
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RechargeRule $rechargeRule)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RechargeRule $rechargeRule)
    {
        //
    }
}
