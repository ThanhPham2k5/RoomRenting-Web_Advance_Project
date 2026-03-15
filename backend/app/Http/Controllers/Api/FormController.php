<?php

namespace App\Http\Controllers\Api;

use App\Filter\FormFilter;
use App\Models\Form;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Http\Resources\FormCollection;
use App\Http\Resources\FormResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class FormController extends Controller
{

    private $allowedIncludes = [
        'account',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Forms = QueryBuilder::for(Form::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('priceMax', FilterOperator::DYNAMIC, '', 'price_max'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('priceMin', FilterOperator::DYNAMIC, '', 'price_min'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::operator('roomType', FilterOperator::DYNAMIC, '', 'room_type'), // =, <>
            AllowedFilter::operator('maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('priceMax','price_max'),
            AllowedSort::field('priceMin','price_min'),
            'area',
            AllowedSort::field('maxOccupants','max_occupants')
        ])
        ->paginate()
        ->appends($request->query());

        return new FormCollection($Forms);
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
    public function store(StoreFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        $form = QueryBuilder::for(Form::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($form->id);

        return new FormResource($form);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        //
    }
}
