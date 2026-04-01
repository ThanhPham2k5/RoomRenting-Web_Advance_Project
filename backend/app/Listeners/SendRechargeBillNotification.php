<?php

namespace App\Listeners;

use App\Models\Payments\RechargeRule;
use App\Events\RechargeBillCreated;
use App\Models\Payments\RechargeBill;
use App\Models\Notification\Notification;

class SendRechargeBillNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RechargeBillCreated $event)
    {
        $rechargeBill = $event->rechargeBill;

        if (! $rechargeBill instanceof RechargeBill) {
            return;
        }

        Notification::create([
            'title' => 'Hoá đơn nạp điểm',
            'content' => 'Đã nạp: ' . $rechargeBill->points . ' điểm với số tiền:'. number_format($rechargeBill->total_money, 0, ',', '.') .'VND cho tài khoản của bạn.',
            'notification_type' => 'transaction',
            'status' => 'unread',
            'account_id' => $rechargeBill->account_id,
            'notifiable_id' => $rechargeBill->id,
            'notifiable_type' => RechargeBill::class,
        ]);
    }
}
