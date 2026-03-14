<?php

namespace App\Filter;


class FormFilter extends ApiFilter{
    protected $safeParms = [
        'priceMax' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'priceMin' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'area' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'ward' => ['eq'],
        'province' => ['eq'],
        'roomType' => ['eq', 'ne'],
        'maxOccupants' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];
    protected $columnMap = [
        'priceMax' => 'price_max',
        'priceMin' => 'price_min',
        'maxOccupants' => 'max_occupants'
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