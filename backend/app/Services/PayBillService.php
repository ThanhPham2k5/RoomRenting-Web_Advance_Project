<?php

namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Payments\PayBillResource;
use App\Models\Payments\PayBill;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PayBillService{
    private $allowedIncludes = [
        'account',
        'payRule',
        'post',
        'notifications'
    ];

    private $allColFilter = [
        'status'
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(PayBill::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::operator('points', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'points',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getPayBill($payBill){
        $payBill = QueryBuilder::for(PayBill::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($payBill->id);

        return $payBill;
    }

    public function updatePayBill($payBill, $data){
        $payBill->update($data);

        return [
            'message' => 'Pay bill updated successfully',
            'payBill' => new PayBillResource($payBill)
        ];
    }

    public function deletePayBill($payBill){
        $payBill->delete();

        return [
            'message' => 'Pay bill deleted successfully'
        ];
    }

    public function restorePayBill($id){
        $payBill = PayBill::onlyTrashed()->findOrFail($id);

        $payBill->restore();

        return [
            'message' => 'PayBill restored successfully'
        ];
    }
}
?>