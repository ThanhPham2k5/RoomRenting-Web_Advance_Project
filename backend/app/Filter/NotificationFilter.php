<?php

namespace App\Filter;

class NotificationFilter extends ApiFilter{
    protected $safeParms = [
        'title' => ['eq'],
        'content' => ['eq'],
        'status' => ['eq', 'ne'],
        'notificationType' => ['eq', 'ne'],
        'notifiableType' => ['eq', 'ne'],
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