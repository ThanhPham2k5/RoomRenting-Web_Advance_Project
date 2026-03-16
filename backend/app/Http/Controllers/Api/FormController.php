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

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new FormFilter();

        $query = Form::query();

        $query = $filter->transform($request, $query);

        return new FormCollection(
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
    public function store(StoreFormRequest $request)
    {
        $validated = $request->validated();

        $form = Form::create($validated);

        return response()->json([
            'message' => 'Form created successfully',
            'form' => new FormResource($form)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
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
        $validated = $request->validated();

        $form->update($validated);

        return response()->json([
            'message' => 'Form updated successfully',
            'form' => new FormResource($form)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();

        return response()->json([
            'message' => 'Form deleted successfully'
        ]);
    }
}
