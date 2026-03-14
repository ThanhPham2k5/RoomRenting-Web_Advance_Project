<?php

namespace App\Filter;

use Illuminate\Http\Request;

class AccountFilter extends ApiFilter{
    protected $safeParms = [
        'role' => ['eq', 'ne'],
        'username' => ['eq'],
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
?>