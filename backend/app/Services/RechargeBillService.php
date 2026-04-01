<?php

namespace App\Services;

use App\Events\RechargeBillCreated;
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Payments\RechargeBillResource;
use App\Models\Account_User\User;
use App\Models\Payments\RechargeBill;
use App\Models\Payments\RechargeRule;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class RechargeBillService{
    private $allowedIncludes = [
        'account',
        'rechargeRule',
        'notifications'
    ];

    private $allColFilter = [
        'status',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(RechargeBill::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::operator('money', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('totalMoney', FilterOperator::DYNAMIC, '', 'total_money'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('vat', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'money',
            AllowedSort::field('totalMoney', 'total_money'),
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getRechargeBill($rechargeBill){
        $rechargeBill = QueryBuilder::for(RechargeBill::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($rechargeBill->id);

        return $rechargeBill;
    }

    public function createRechargeBill($data){
        $rechargeRule = RechargeRule::where('id', $data['recharge_rule_id'])->first();

        $points_after_exchange = (int)($data['total_money'] * $rechargeRule->points / $rechargeRule->money);

        $rechargeBill = RechargeBill::create([
            ...$data,
            'points' => $points_after_exchange]);
        
        // Increment user points
        $account = $rechargeBill->account;
        $user = User::where('account_id', $account->id)->first();
        
        $user->increment('points', $points_after_exchange);
        
        event(new RechargeBillCreated($rechargeBill));

        return [
            'message' => 'Recharge bill created successfully',
            'rechargeBill' => new RechargeBillResource  ($rechargeBill)
        ];
    }

    public function updateRechargeBill($rechargeBill, $data){
        $rechargeBill->update($data);

        return [
            'message' => 'Recharge bill updated successfully',
            'rechargeBill' => new RechargeBillResource($rechargeBill)
        ];
    }

    public function deleteRechargeBill($rechargeBill){
        $rechargeBill->delete();

        return [
            'message' => 'Recharge bill deleted successfully'
        ];
    }

    public function restoreRechargeBill($id){
        $rechargeBill = RechargeBill::onlyTrashed()->findOrFail($id);

        $rechargeBill->restore();

        return response()->json([
            'message' => 'RehargeBill restored successfully',
        ]);
    }
}
?>