<?php

namespace App\Services;

use App\Events\PostCreated;
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Posts\PostImage;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PostImageService{
    private $allowedIncludes = [
        'post',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(PostImage::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::operator('order', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('post.id', FilterOperator::DYNAMIC) // =, <>, >, <, >=, <=
        ])
        ->allowedSorts([
            'id',
            'order',
            AllowedSort::field('createdAt', 'created_at'),
            AllowedSort::field('updateAt', 'updated_at'),
        ]);

        return $query;
    }

    public function getPostImage($postImage){
        $postImage = QueryBuilder::for(PostImage::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($postImage->id);

        return $postImage;
    }
}
?>