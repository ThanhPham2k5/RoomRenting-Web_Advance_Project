<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Posts\FavoriteResource;
use App\Models\Posts\Favorite;
use App\Sort\PostRelatedSort;
use DeepCopy\f001\A;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class FavoriteService{
    private $allowedIncludes = [
        'account',
        'post',
        'post.postImages',
    ];

    private $allColFilter = [
        'post.title',
        'post.houseNumber' => 'post.house_number',
        'post.ward',
        'post.province',
        'post.description',
        'post.status',
        'post.roomType' => 'post.room_type'
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Favorite::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::exact('post.id'),
            AllowedFilter::exact('post.status'),
            AllowedFilter::partial('post.title'),
            AllowedFilter::operator('post.price', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('post.area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('post.houseNumber', 'house_number'),
            AllowedFilter::partial('post.ward'),
            AllowedFilter::partial('post.province'),
            AllowedFilter::partial('post.description'),
            AllowedFilter::operator('post.deposit', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('post.authorized', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::exact('post.roomType', 'room_type'),
            AllowedFilter::operator('post.maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::custom('postPrice', new PostRelatedSort('price')),
            AllowedSort::field('createdAt', 'created_at'),
            'post.price',
        ]);

        return $query;
    }

    public function getFavorite($favorite){
        $favorite = QueryBuilder::for(Favorite::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($favorite->id);

        return $favorite;
    }

    public function createFavorite($data){
        $favorite = Favorite::create($data);

        return [
            'message' => 'Favorite created successfully',
            'favorite' => new FavoriteResource($favorite)
        ];
    }

    public function updateFavorite($favorite, $data){
        $favorite->update($data);

        return [
            'message' => 'Favorite updated successfully',
            'favorite' => new FavoriteResource($favorite)
        ];
    }

    public function deleteFavorite($favorite){
        $favorite->forceDelete();

        return [
            'message' => 'Favorite deleted successfully'
        ];
    }
}
?>