<?php

namespace App\Http\Controllers\Api\Posts;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Posts\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\Posts\CommentCollection;
use App\Http\Resources\Posts\CommentResource;
use App\Services\CommentService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class CommentController extends Controller
{
    use AuthorizesRequests;

    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->commentService->buildGetAllQuery();

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

        $result = $this->commentService->createComment($validated);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment = $this->commentService->getComment($comment);

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

        $result = $this->commentService->updateComment($comment, $validated);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {   
        $this->authorize('delete', $comment);

        $result = $this->commentService->deleteComment($comment);

        return response()->json($result);
    }
    public function restore($id)
    {
        $result = $this->commentService->restoreComment($id);

        return response()->json($result);
    }
}
