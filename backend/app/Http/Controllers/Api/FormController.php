<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Posts\PostResource;
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
use App\Models\Posts\Post;
use App\Http\Resources\Posts\PostCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FormController extends Controller
{
    use AuthorizesRequests;
    private $allowedIncludes = [
        'account',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Form::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('priceMax', FilterOperator::DYNAMIC, '', 'price_max'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('priceMin', FilterOperator::DYNAMIC, '', 'price_min'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::exact('roomType', 'room_type'),
            AllowedFilter::operator('maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('priceMax','price_max'),
            AllowedSort::field('priceMin','price_min'),
            'area',
            AllowedSort::field('maxOccupants','max_occupants')
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Forms = $query->get();
        } else {
            $Forms = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

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
        $user = $request->user();
        if (Form::where('account_id', $user->id)->exists()) {
            return response()->json([
                'message' => 'You already have a form. Please update it instead.'
            ], 400);
        }

        $validated = $request->validated();
        
        $validated['account_id'] = $user->id;

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
        $this->authorize('view', $form);

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
        $this->authorize('update', $form);

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

    /*
     * Get recommended posts based on user's form criteria
    */
    public function getRecommendedPosts(Request $request)
    {
        $user = $request->user();

        $form = Form::where('account_id', $user->id)->first();

        if (!$form) {
            return response()->json([
                'message' => 'You need to create a form first to get recommendations'
            ], 404);
        }

        $query = Post::query()
            // No need to recommend user's own posts
            ->where('user_id', '!=', $user->id);

        // FILTER

        $query->when($form->price_min, fn($q) =>
            $q->where('price', '>=', $form->price_min)
        );

        $query->when($form->price_max, fn($q) =>
            $q->where('price', '<=', $form->price_max)
        );

        // not tested yet
        $query->when($form->area, function ($q) use ($form) {
            $percent = 0.2; // ±20%

            $min = $form->area * (1 - $percent);
            $max = $form->area * (1 + $percent);

            $q->whereBetween('area', [$min, $max]);
        });

        $query->when($form->ward, fn($q) =>
            $q->where('ward', 'like', "%{$form->ward}%")
        );

        $query->when($form->province, fn($q) =>
            $q->where('province', 'like', "%{$form->province}%")
        );

        $query->when($form->room_type, fn($q) =>
            $q->where('room_type', $form->room_type)
        );

        $query->when($form->max_occupants, fn($q) =>
            $q->where('max_occupants', '>=', $form->max_occupants)
        );

        if ($query->count() === 0) {
            return response()->json([
                'message' => 'No recommended posts found based on your form criteria'
            ], 404);
        }

        $posts = $query
            ->latest()
            ->get();
        // Returning all posts
        return response()->json([
            'message' => 'Recommended posts fetched successfully',
            'data' => PostResource::collection($posts)
        ]);
    }

}
