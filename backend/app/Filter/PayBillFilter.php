<?php

namespace App\Filter;


class PayBillFilter extends ApiFilter{
    protected $safeParms = [
        'points' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
            
    ];
    protected $columnMap = [];
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