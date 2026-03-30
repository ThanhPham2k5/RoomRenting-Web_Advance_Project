<?php

namespace App\Services;

use App\Events\PostCreated;
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Posts\PostResource;
use App\Models\Posts\Post;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PostService{
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

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Post::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user.account_id'),
            AllowedFilter::exact('employee.account_id'),
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
            AllowedSort::field('maxOccupants','max_occupants'),
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getPost($post){
        $post = QueryBuilder::for(Post::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($post->id);

        return $post;
    }

    public function createPost($data){

        //
    }

    public function updatePost($post, $data){
        $post->update($data);

        // If status changed to 'completed', fire PostCreated event
        if ($data['status'] === 'completed') {
            event(new PostCreated($post));
        }

        return $post;
    }

    public function deletePost($post){
        return DB::transaction(function () use ($post) {
            $post->postImages()->delete();
            $post->comments()->delete();
            $post->favorites()->delete();
            $post->delete();

            return [
                'message' => 'Post deleted successfully'
            ];
        });   
    }

    public function restorePost($id){
        return DB::transaction(function () use ($id) {
            $post = Post::onlyTrashed()->findOrFail($id);
    
            $post->postImages()->restore();
            $post->comments()->restore();
            $post->favorites()->restore();
            $post->restore();
    
            return [
                'message' => 'Post restored successfully',
                'post'    => new PostResource($post->load('postImages')),
            ];
        }); 
    }
}
?>