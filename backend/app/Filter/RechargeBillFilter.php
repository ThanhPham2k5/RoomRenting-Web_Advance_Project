<?php

namespace App\Filter;


class RechargeBillFilter extends ApiFilter{
    protected $safeParms = [
        'money' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'totalMoney' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'vat' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
            
    ];
    protected $columnMap = [
        'totalMoney' => 'total_money'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];
}
?>