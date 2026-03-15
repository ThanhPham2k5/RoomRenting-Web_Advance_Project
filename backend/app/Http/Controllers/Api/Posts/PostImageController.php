<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Posts\PostImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostImageRequest;
use App\Http\Requests\UpdatePostImageRequest;
use App\Http\Resources\Posts\PostImageCollection;
use App\Http\Resources\Posts\PostImageResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PostImageController extends Controller
{

    private $allowedIncludes = [
        'post',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $PostImages = QueryBuilder::for(PostImage::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('order', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('post.id', FilterOperator::DYNAMIC) // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            'order'
        ])
        ->paginate()
        ->appends($request->query());

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PostImage $postImage)
    {
        $postImage = QueryBuilder::for(PostImage::class)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostImage $postImage)
    {
        //
    }
}
