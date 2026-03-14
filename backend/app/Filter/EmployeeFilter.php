<?php

namespace App\Filter;

class EmployeeFilter extends ApiFilter{
    protected $safeParms = [
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
    ];
}
?>