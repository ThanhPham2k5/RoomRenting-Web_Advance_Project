<?php

namespace App\Filter;

class PayRuleFilter extends ApiFilter{
    protected $safeParms = [
        'points' => ['eq', 'lt', 'gt', 'lte', 'gte'],
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