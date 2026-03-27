<?php

namespace App\Http\Controllers\Api\Posts;

use App\Filter\DateFilter;
use App\Models\Posts\Favorite;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Http\Resources\Posts\FavoriteCollection;
use App\Http\Resources\Posts\FavoriteResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class FavoriteController extends Controller
{
    use AuthorizesRequests;
    private $allowedIncludes = [
        'account',
        'post',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Favorite::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Favorites = $query->get();
        } else {
            $Favorites = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new FavoriteCollection($Favorites);
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
    public function store(StoreFavoriteRequest $request)
    {
        $validated = $request->validated();

        $favorite = Favorite::create($validated);

        return response()->json([
            'message' => 'Favorite created successfully',
            'favorite' => new FavoriteResource($favorite)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        $this->authorize('view', $favorite);

        $favorite = QueryBuilder::for(Favorite::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($favorite->id);

        return new FavoriteResource($favorite);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        $this->authorize('update', $favorite);

        $validated = $request->validated();

        $favorite->update($validated);

        return response()->json([
            'message' => 'Favorite updated successfully',
            'favorite' => new FavoriteResource($favorite)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        $this->authorize('delete', $favorite);

        $favorite->delete();

        return response()->json([
            'message' => 'Favorite deleted successfully'
        ]);
    }
}
