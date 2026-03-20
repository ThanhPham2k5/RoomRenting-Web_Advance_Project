<?php

namespace App\Listeners;

use App\Events\PayBillCreated;
use App\Models\Payments\PayBill;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Notification\Notification;

class SendPayBillNotification
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
    public function handle(PayBillCreated $event)
    {
        $payBill = $event->payBill;

        if (! $payBill instanceof PayBill) {
            return;
        }

        Notification::create([
            'title' => 'Thanh toán hoá đơn',
            'content' => 'Hoá đơn thanh toán #' . $payBill->id . ' đã được tạo. Số điểm: ' . $payBill->points . ', trạng thái: ' . $payBill->status . '.',
            'notification_type' => 'transaction',
            'status' => 'unread',
            'account_id' => $payBill->account_id,
            'notifiable_id' => $payBill->id,
            'notifiable_type' => PayBill::class,
        ]);
    }
}
