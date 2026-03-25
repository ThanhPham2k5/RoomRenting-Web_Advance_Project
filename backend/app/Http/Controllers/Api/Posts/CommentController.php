<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Posts\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\Posts\CommentCollection;
use App\Http\Resources\Posts\CommentResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class CommentController extends Controller
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
        $query = QueryBuilder::for(Comment::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::partial('content')
        ])
        ->allowedSorts([
            'id',
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Comments = $query->get();
        } else {
            $Comments = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new CommentCollection($Comments);
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
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $comment = Comment::create($validated);

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => new CommentResource($comment)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment = QueryBuilder::for(Comment::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($comment->id);

        return new CommentResource($comment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validated();

        $comment->update($validated);

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => new CommentResource($comment)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {   
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
    public function restore($id)
    {
        $comment = Comment::onlyTrashed()->findOrFail($id);
 
        $comment->restore();
 
        return response()->json([
            'message' => 'Comment restored successfully',
            'comment'    => new CommentResource($comment),
        ]);
    }
}
