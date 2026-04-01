<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Posts\FavoriteResource;
use App\Models\Posts\Favorite;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class FavoriteService{
    private $allowedIncludes = [
        'account',
        'post',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Favorite::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::exact('post.id'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('createdAt', 'created_at'),
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