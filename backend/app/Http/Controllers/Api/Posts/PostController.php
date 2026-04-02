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
use App\Models\Account_User\Account;
use App\Models\Form;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

            // get images from post data
            $files = $request->file('images');
            $orders = $request->input('orders');

            // combine files and orders into one array
            $images = collect($files)->map(function ($file, $key) use ($orders) {
                return [
                    'file' => $file,
                    'order' => $orders[$key]
                ];
            })->toArray();

            // remove images from validated data to prevent mass assignment error
            unset($validated['images']);
            unset($validated['orders']);

            // Create post
            $post = Post::create($validated);

            // Store images
            if ($images) {
                foreach ($images as $imageData) {
                    $file = $imageData['file'];
                    $order = $imageData['order'];

                    // Rename to order
                    $filename = $order . '.' . $file->getClientOriginalExtension();

                    // Save file
                    $path = $file->storeAs(
                        "posts/{$post->id}/images",
                        $filename,
                        "public"
                    );

                    // Save DB
                    $post->postImages()->create([
                        'image_post_url' => $path,
                        'order' => $order,
                    ]);
                }
            }

            // Fire create post event
            event(new StatusPostCreated($post, $request['content'], $request['title']));

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
        
        // if ($request->status === $post->status) {
        //     return response()->json([
        //         'message' => 'Can not update post with similiar status'
        //     ]);            
        // }

        return DB::transaction(function () use ($request, $post, $validated) {

            // process images if exist
            if ($request->hasFile('images')) {
                // get images & orders from request
                $files = $request->file('images');
                $orders = $request->input('orders');

                // combine files and orders into one array
                $images = collect($files)->map(function ($file, $key) use ($orders) {
                    return [
                        'file' => $file,
                        'order' => $orders[$key]
                    ];
                })->toArray();

                // delete old images if exist
                // foreach($post->postImages as $postImage){
                //     if(in_array($postImage->order, $orders)){ // if order in request, delete file of said order
                //         // delete file
                //         Storage::disk('public')->delete($postImage->image_post_url);

                //         // delete DB record
                //         $postImage->delete();
                //     }
                // }
                
                // store new images
                // foreach($images as $imageData){
                //     $file = $imageData['file'];
                //     $order = $imageData['order'];
                 
                //     // rename to order
                //     $filename = $order . '.' . $file->getClientOriginalExtension();

                //     // save file
                //     $path = $file->storeAs(
                //         "posts/{$post->id}/images",
                //         $filename,
                //         "public"
                //     );

                //     $newImages[] = [
                //         'image_post_url' => $path,
                //         'order' => $order,
                //     ];
                // }

                $newImages = [];
                foreach ($files as $key => $file) {
                    $newImages[] = [
                        'file' => $file, // Truyền trực tiếp đối tượng UploadedFile
                        'order' => $orders[$key]
                    ];
                }
                
                $validated['postImages'] = $newImages;
                $validated['deleted_orders'] = $request->input('deleted_orders', []); // get orders to delete from request

            }

            $post = $this->postService->updatePost($post, $validated);

            event(new StatusPostCreated($post, $request['content'], $request['title']));

            return response()->json([
                'message' => 'Post updated successfully',
                'post' => new PostResource($post)
            ]);
        });     
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

    public function getRecommendedPosts(Request $request, Account $account)
    {
        $form = Form::where('account_id', $account->id)->first();

        if (!$form) {
            return response()->json([
                'message' => 'You need to create a form first to get recommendations'
            ], 404);
        }

        $query = $this->postService->getQueryRecommendedPosts($form, $account);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $posts = $query->get();
        } else {
            $posts = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new PostCollection($posts);
    }
}
