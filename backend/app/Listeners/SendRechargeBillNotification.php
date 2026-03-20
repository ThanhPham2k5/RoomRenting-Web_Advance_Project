<?php

namespace App\Listeners;

use App\Models\Payments\RechargeRule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
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

        $rechargeRule = RechargeRule::where('id', $rechargeBill->recharge_rule_id)->first();

        Notification::create([
            'title' => 'Thanh toán hoá đơn',
            'content' => 'Hoá đơn thanh toán #' . $rechargeBill->id . ' đã được tạo. Số điểm: ' . $rechargeRule->points . ', trạng thái: ' . $rechargeBill->status . '.',
            'notification_type' => 'transaction',
            'status' => 'unread',
            'account_id' => $rechargeBill->account_id,
            'notifiable_id' => $rechargeBill->id,
            'notifiable_type' => RechargeBill::class,
        ]);
    }
}
