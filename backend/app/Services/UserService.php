<?php
namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Account_User\UserResource;
use App\Models\Account_User\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class UserService {
    private $allowedIncludes = [
        'account',
        'personalInfo',
        'posts',
    ];

    private $allColFilter = [
        'points',
        'account.username',
        'account.role',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(User::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('account.username'),
            AllowedFilter::exact('account.role'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'points',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getUser($user){
        $user = QueryBuilder::for(User::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($user->id);
        
        return $user;
    }

    public function updateUser($user, $data){
        $user->update($data);

        return [
            'message' => 'User updated successfully',
            'user' => new UserResource($user)
        ];
    }
}

?>