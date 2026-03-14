<?php

namespace App\Filter;

class UserFilter extends ApiFilter{
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