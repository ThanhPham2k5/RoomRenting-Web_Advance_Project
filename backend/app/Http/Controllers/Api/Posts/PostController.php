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
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use AuthorizesRequests;
    private $allowedIncludes = [
        'user',
        'employee',
        'postImages',
        'comments',
        'comments.account',
        'payBills',
        'favorites.account',
        'notifications'
    ];

    private $allColFilter = [
        'title',
        'houseNumber' => 'house_number',
        'ward',
        'province',
        'description',
        'status',
        'roomType' => 'room_type'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Post::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::partial('title'),
            AllowedFilter::operator('price', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('houseNumber', 'house_number'),
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::partial('description'),
            AllowedFilter::operator('deposit', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
            AllowedFilter::operator('authorized', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::exact('roomType', 'room_type'),
            AllowedFilter::operator('maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'price',
            'area',
            'deposit',
            AllowedSort::field('maxOccupants','max_occupants')
        ]);

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
        $post = QueryBuilder::for(Post::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($post->id);

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

        $post->update($validated);

        // If status changed to 'completed', fire PostCreated event
        if ($validated['status'] === 'completed') {
            event(new PostCreated($post));
        }
        event(new StatusPostCreated($post, $request->comment));

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
        return DB::transaction(function () use ($post) {
            $this->authorize('delete', $post);
            
            $post->postImages()->delete();
            $post->comments()->delete();
            $post->favorites()->delete();
            $post->delete();

            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        });   
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
 
        $post->postImages()->restore();
        $post->comments()->restore();
        $post->favorites()->restore();
        $post->restore();
 
        return response()->json([
            'message' => 'Post restored successfully',
            'post'    => new PostResource($post->load('postImages')),
        ]);
    }


}
