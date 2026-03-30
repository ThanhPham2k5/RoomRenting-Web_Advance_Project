<?php
namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Payments\PayRuleResource;
use App\Models\Payments\PayRule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PayRuleService{
    private $allowedIncludes = [
        'payBills',
    ];

    private $allColFilter = [
        
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(PayRule::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'points',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getPayRule($payRule){
        $payRule = QueryBuilder::for(PayRule::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($payRule->id);

        return $payRule;
    }

    public function createPayRule($data){
        $payRule = PayRule::create($data);
        $payRule->delete();

        return [
            'message' => 'Pay rule created successfully',
            'payRule' => new PayRuleResource($payRule),
        ];
    }

    public function restorePayRule($id){
        PayRule::query()->delete();
        $payRule = PayRule::onlyTrashed()->findOrFail($id);
        
        $payRule->restore();

        return [
            'message' => 'PayRule restored successfully'
        ];
    }
}
?>