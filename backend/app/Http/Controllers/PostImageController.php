<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostImageRequest;
use App\Http\Requests\UpdatePostImageRequest;

class PostImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
