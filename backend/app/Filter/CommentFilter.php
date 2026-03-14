<?php

namespace App\Filter;


class CommentFilter extends ApiFilter{
    protected $safeParms = [
        'content' => ['eq'],
            
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
    ];
}
?>