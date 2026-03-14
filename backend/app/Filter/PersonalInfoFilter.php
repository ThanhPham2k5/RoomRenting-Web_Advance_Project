<?php

namespace App\Filter;

class PersonalInfoFilter extends ApiFilter{
    protected $safeParms = [
        'dateOfBirth' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'gender' => ['eq', 'ne'],
        'houseNumber' => ['eq'],
        'ward' => ['eq'],
        'province' => ['eq'],
        'phoneNumber' => ['eq'],
        'name' => ['eq'],
        'pid' => ['eq'],
    ];
    protected $columnMap = [
        'dateOfBirth' => 'date_of_birth',
        'houseNumber' => 'house_number',
        'phoneNumber' => 'phone_number',
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