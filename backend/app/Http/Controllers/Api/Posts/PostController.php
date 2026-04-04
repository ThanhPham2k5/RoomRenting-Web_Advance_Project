<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Payments\PayRule;
use App\Models\Payments\PayBill;
use App\Models\Posts\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Posts\PostCollection;
use App\Http\Resources\Posts\PostResource;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Events\StatusPostCreated;
use App\Models\Account_User\Account;
use App\Models\Form;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
use App\Events\PayBillCreated;


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
            
            // set reason to null if not exist to prevent mass assignment error
            $validated['reason'] = null;

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
            event(new StatusPostCreated($post, $request['titleNotification'] ?? null));

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


                $newImages = [];
                foreach ($files as $key => $file) {
                    $newImages[] = [
                        'file' => $file,
                        'order' => $orders[$key]
                    ];
                }
                
                $validated['postImages'] = $newImages;
                $validated['deleted_orders'] = $request->input('deleted_orders', []); // get orders to delete from request

            }

            $post = $this->postService->updatePost($post, $validated);

            event(new StatusPostCreated($post, $request['titleNotification'] ?? null));

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

    public function postPayment(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        if ($post->status !== 'expired') {
            return response()->json([
                'message' => 'Chỉ thanh toán được những bài đăng quá hạn.'
            ], 400);
        }

        $user = $post->user;
        $payRule = PayRule::first();
        $points = $payRule->points;
        $payRule = PayRule::firstOrFail();

        if ($user->points > $points) {
            $user->decrement('points', $points);
                $paybill = PayBill::create([
                    'account_id' => $user->account->id,
                    'status' => 'completed',
                    'points' => $points,
                    'pay_rule_id' => $payRule->id,
                    'post_id' => $post->id,
                ]);

            $post->update(['status' => 'completed',
                'next_payment_date' => now()->addMonth()]);
            event(new PayBillCreated($paybill));

        } else {
            return response()->json([
                'message' => 'Tài khoản của bạn không đủ điểm.'
            ], 400);
        }

        return response()->json([
            'message' => 'Thanh toán thành công.',
        ]);

    }
}
