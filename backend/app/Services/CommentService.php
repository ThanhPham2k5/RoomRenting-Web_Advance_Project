<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Posts\CommentResource;
use App\Models\Posts\Comment;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CommentService{
    private $allowedIncludes = [
        'account',
        'post',
    ];

    private $allColFilter = [
        'content',
        'account.username',
    ];

    public function buildGetAllQuery(){
       $query = QueryBuilder::for(Comment::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::exact('post.id'),
            AllowedFilter::partial('content'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getComment($comment){
        $comment = QueryBuilder::for(Comment::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($comment->id);

        return $comment;
    }

    public function createComment($data){

        $comment = Comment::create($data);

        return [
            'message' => 'Comment created successfully',
            'comment' => new CommentResource($comment)
        ];
    }

    public function updateComment($comment, $data){

        $comment->update($data);

        return [
            'message' => 'Comment updated successfully',
            'comment' => new CommentResource($comment)
        ];
    }

    public function deleteComment($comment){
        $comment->delete();

        return [
            'message' => 'Comment deleted successfully'
        ];
    }

    public function restoreComment($id){
        $comment = Comment::onlyTrashed()->findOrFail($id);
 
        $comment->restore();
 
        return [
            'message' => 'Comment restored successfully',
            'comment' => new CommentResource($comment),
        ];
    }
}
?>