<?php
namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Payments\RechargeRuleResource;
use App\Models\Payments\RechargeRule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class RechargeRuleService{
    private $allowedIncludes = [
        'rechargeBills',
    ];

    private $allColFilter = [
        
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(RechargeRule::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('money', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=  
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'points',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getRechargeRule($rechargeRule){
         $rechargeRule = QueryBuilder::for(RechargeRule::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($rechargeRule->id);

        return $rechargeRule;
    }

    public function createRechargeRule($data){
        $rechargeRule = RechargeRule::create([
            $data
            // 'status' => 'inactive',
        ]);

        $rechargeRule->delete();

        return [
            'message' => 'Recharge rule created successfully',
            'rechargeRule' => new RechargeRuleResource($rechargeRule)
        ];
    }

    public function restoreRechargeRule($id){
        RechargeRule::query()->delete();
        $rechargeRule = RechargeRule::onlyTrashed()->findOrFail($id);

        $rechargeRule->restore();

        return response()->json([
            'message' => 'RechargeRule restored successfully'
        ]);
    }
}
?>