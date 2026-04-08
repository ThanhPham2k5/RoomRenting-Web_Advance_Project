<?php
namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Account_User\PersonalInfoResource;
use App\Models\Account_User\PersonalInfo;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PersonalInfoService{
    private $allowedIncludes = [
        'user',
        'employee',
        'user.account',
        'employee.account'
    ];

    private $allColFilter = [
        'gender',
        'houseNumber' => 'house_number',
        'ward',
        'province',
        'name',
        'pid',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(PersonalInfo::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('gender', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::partial('houseNumber', 'house_number'),
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::partial('name'),
            AllowedFilter::partial('pid'),
            AllowedFilter::custom('dateOfBirth', new DateFilter(), 'date_of_birth'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('dateOfBirth', 'date_of_birth'),
            AllowedSort::field('createdAt', 'created_at'),
            AllowedSort::field('updateAt', 'updated_at'),
        ]);

        return $query;
    }

    public function getPersonalInfo($personalInfo){
        $personalInfo = QueryBuilder::for(PersonalInfo::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($personalInfo->id);

        return $personalInfo;
    }

    public function updatePersonalInfo($personalInfo, $data){
        
        $personalInfo->update($data);

        return [
            'message' => 'Personal Info update successfully',
            'personalInfo' => new PersonalInfoResource($personalInfo)
        ];
    }
}
?>
