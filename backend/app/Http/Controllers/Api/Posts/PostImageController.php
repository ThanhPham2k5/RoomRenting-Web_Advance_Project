<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Posts\PostImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostImageRequest;
use App\Http\Requests\UpdatePostImageRequest;
use App\Http\Resources\Posts\PostImageCollection;
use App\Http\Resources\Posts\PostImageResource;

class PostImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PostImageCollection(PostImage::all());
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
