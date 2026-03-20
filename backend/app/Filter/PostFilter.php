<?php

namespace App\Filter;


class PostFilter extends ApiFilter{
    protected $safeParms = [
        'title' => ['eq', 'like'],
        'price' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'area' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'houseNumber' => ['eq', 'like'],
        'ward' => ['eq', 'like'],
        'province' => ['eq', 'like'],
        'description' => ['eq', 'like'],
        'deposit' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status' => ['eq', 'ne', 'in'],
        'authorized' => ['eq', 'ne'],
        'roomType' => ['eq', 'ne', 'in'],
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
        'gte' => '>=',
    ];
}
?>