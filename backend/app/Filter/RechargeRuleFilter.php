<?php

namespace App\Filter;


class RechargeRuleFilter extends ApiFilter{
    protected $safeParms = [
        'points' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'money' => ['eq', 'lt', 'gt', 'lte', 'gte'],
            
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];
}
?>