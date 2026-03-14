<?php

namespace App\Filter;


class PostFilter extends ApiFilter{
    protected $safeParms = [
        'title' => ['eq'],
        'price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'area' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'houseNumber' => ['eq'],
        'ward' => ['eq'],
        'province' => ['eq'],
        'description' => ['eq'],
        'deposit' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'authorized' => ['eq', 'ne'],
        'roomType' => ['eq', 'ne'],
        'maxOccupants' => ['eq', 'lt', 'gt', 'lte', 'gte'],
            
    ];
    protected $columnMap = [
        'houseNumber' => 'house_number',
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