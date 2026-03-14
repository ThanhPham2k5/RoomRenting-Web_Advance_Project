<?php

namespace App\Filter;

use Illuminate\Http\Request;

class AccountFilter extends ApiFilter{
    protected $safeParms = [
        'role' => ['eq', 'ne', 'in'],
        'username' => ['eq', 'like'],
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
?>