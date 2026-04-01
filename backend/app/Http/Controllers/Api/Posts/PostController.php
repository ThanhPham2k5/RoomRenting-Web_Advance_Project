<?php

namespace App\Http\Controllers\Api\Posts;

use _PHPStan_781aefaf6\Composer\XdebugHandler\Status;
use App\Listeners\SendStatusPostNotification;
use App\Models\Posts\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Posts\PostCollection;
use App\Http\Resources\Posts\PostResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use App\Events\PostCreated;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Events\StatusPostCreated;
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use AuthorizesRequests;
    
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->postService->buildGetAllQuery();

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Posts = $query->get();
        } else {
            $Posts = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new PostCollection($Posts);
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
    public function store(StorePostRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $validated = $request->validated();

            // Remove images from post data
            $images = $request->file('images');

            unset($validated['images']);

            // Create post
            $post = Post::create($validated);

            // Store images
            if ($images) {
                foreach ($images as $index => $image) {
                    // Rename to order
                    $filename = ($index + 1) . '.' . $image->getClientOriginalExtension();

                    // Save file
                    $path = $image->storeAs(
                        "posts/{$post->id}/images",
                        $filename,
                        "public"
                    );

                    // Save DB
                    $post->postImages()->create([
                        'image_post_url' => $path,
                        'order' => $index + 1,
                    ]);
                }
            }

            // Fire create image event
            event(new StatusPostCreated($post, $request->comment));

            return response()->json([
                'message' => 'Post created successfully',
                'post' => new PostResource($post->load('postImages'))
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $this->postService->getPost($post);

        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validated();
        
        if ($request->status === $post->status) {
            return response()->json([
                'message' => 'Can not update post with similiar status'
            ]);            
        }

        $post = $this->postService->updatePost($post, $validated);
        
        // event(new StatusPostCreated($post, $request->comment));

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => new PostResource($post)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $result = $this->postService->deletePost($post);

        return response()->json($result);   
    }

    public function restore($id)
    {
        $result = $this->postService->restorePost($id);
 
        return response()->json($result);
    }


}
