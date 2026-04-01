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
                    'title' => 'Thanh toán chi phí duy trì bài đăng',
                    'content' => 'Đã trừ: ' . $payBill->points . ' điểm. Vui lòng kiểm tra lại số điểm của bạn.',
                    'notification_type' => 'transaction',
                    'status' => 'unread',
                    'account_id' => $payBill->account_id,
                    'notifiable_id' => $payBill->id,
                    'notifiable_type' => PayBill::class,
                ]);
    
                return;
        } 
        
        Notification::create([
            'title' => 'Thanh toán chi phí duy trì bài đăng',
            'content' => 'Đã trừ: ' . $payBill->points . 'điểm.',
            'notification_type' => 'transaction',
            'status' => 'unread',
            'account_id' => $payBill->account_id,
            'notifiable_id' => $payBill->id,
            'notifiable_type' => PayBill::class,
        ]);
        
    }
}
