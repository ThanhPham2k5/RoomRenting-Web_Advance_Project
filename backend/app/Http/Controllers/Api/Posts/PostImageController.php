<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Posts\PostImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostImageRequest;
use App\Http\Requests\UpdatePostImageRequest;
use App\Http\Resources\Posts\PostImageCollection;
use App\Http\Resources\Posts\PostImageResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PostImageController extends Controller
{
    use AuthorizesRequests;
    private $allowedIncludes = [
        'post',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(PostImage::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('order', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('post.id', FilterOperator::DYNAMIC) // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            'order'
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $PostImages = $query->get();
        } else {
            $PostImages = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new PostImageCollection($PostImages);
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
    public function store(StorePostImageRequest $request)
    {
        // Will be remove

        // $validated = $request->validated();

        // $postImage = PostImage::create($validated);

        // return response()->json([
        //     'message' => 'Post image created successfully',
        //     'post_image' => new PostImageResource($postImage)
        // ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(PostImage $postImage)
    {
        $postImage = QueryBuilder::for(PostImage::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($postImage->id);

        return new PostImageResource($postImage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostImage $postImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostImageRequest $request, PostImage $postImage)
    {
        // Will be remove

        // $this->authorize('update', $postImage);

        // $validated = $request->validated();

        // $postImage->update($validated);

        // return response()->json([
        //     'message' => 'Post image updated successfully',
        //     'post_image' => new PostImageResource($postImage)
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostImage $postImage)
    {
        // Will be remove

        // $this->authorize('delete', $postImage);
        // $postImage->delete();

        // return response()->json([
        //     'message' => 'Post image deleted successfully'
        // ]);
    }
}
