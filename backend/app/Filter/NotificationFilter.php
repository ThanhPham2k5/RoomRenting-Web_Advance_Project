<?php

namespace App\Filter;

class NotificationFilter extends ApiFilter{
    protected $safeParms = [
        'title' => ['eq', 'like'],
        'content' => ['eq', 'like'],
        'status' => ['eq', 'ne', 'in'],
        'notificationType' => ['eq', 'ne', 'in'],
        'notifiableType' => ['eq', 'ne', 'in'],
    ];
    protected $columnMap = [
        'notificationType' => 'notification_type',
        'notifiableType' => 'notifiable_type',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!='
    ];
}
?>