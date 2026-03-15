<?php

namespace App\Filter;


class CommentFilter extends ApiFilter{
    protected $safeParms = [
        'content' => ['eq', 'like'],
            
    ];
    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => '=',
    ];
}
?>