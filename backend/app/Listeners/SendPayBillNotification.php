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

        if ($payBill->status === 'failed') {
                Notification::create([
                    'title' => 'Thanh toán hoá đơn thất bại',
                    'content' => 'Hoá đơn thanh toán #' . $payBill->id . ' đã thất bại. Số điểm: ' . $payBill->points . '. Vui lòng kiểm tra lại số điểm của bạn.',
                    'notification_type' => 'transaction',
                    'status' => 'unread',
                    'account_id' => $payBill->account_id,
                    'notifiable_id' => $payBill->id,
                    'notifiable_type' => PayBill::class,
                ]);
    
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
