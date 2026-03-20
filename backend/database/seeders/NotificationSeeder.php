<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Notification\Notification;
use App\Models\Payments\PayBill;
use App\Models\Payments\RechargeBill;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $recharges = RechargeBill::all();
        $pays = PayBill::all();

        $notifiables = $posts
            ->concat($recharges)
            ->concat($pays)
            ->random(30);

        foreach ($notifiables as $model) {

            $data = $this->generateNotification($model);

            if (empty($data)) continue; // skip invalid model

            Notification::create([
                ...$data,

                'status' => collect(['read', 'unread'])->random(),
                'account_id' => $data['account_id'],

                'notifiable_id' => $model->id,
                'notifiable_type' => get_class($model),

                'created_at' => now()->subDays(rand(0, 7)),
            ]);
        }
    }

    private function generateNotification($model)
    {
        // POST
        if ($model instanceof Post) {
            return [
                'account_id' => $model->user->account_id,
                'notification_type' => 'news',

                'title' => match($model->status) {
                    'completed' => 'Post approved',
                    'pending' => 'Post is under review',
                    'expired' => 'Post expired',
                    'failed' => 'Post approval failed',
                    default => 'Post update'
                },

                'content' => match($model->status) {
                    'completed' => "Your post \"{$model->title}\" has been approved and is now visible.",
                    'pending' => "Your post \"{$model->title}\" is being reviewed.",
                    'expired' => "Your post \"{$model->title}\" has expired.",
                    'failed' => "Your post \"{$model->title}\" was rejected.",
                    default => "Your post \"{$model->title}\" has been updated."
                },
            ];
        }

        // PAY BILL
        if ($model instanceof PayBill) {
            return [
                'account_id' => $model->account_id,
                'notification_type' => 'transaction',

                'title' => match($model->status) {
                    'completed' => 'Payment successful',
                    'pending' => 'Payment pending',
                    'failed' => 'Payment failed',
                },

                'content' => match($model->status) {
                    'completed' => "You have been charged {$model->points} points for your post.",
                    'pending' => "Your payment of {$model->points} points is being processed.",
                    'failed' => "Payment of {$model->points} points failed. Please check your balance.",
                },
            ];
        }

        // RECHARGE BILL
        if ($model instanceof RechargeBill) {
            return [
                'account_id' => $model->account_id,
                'notification_type' => 'transaction',

                'title' => match($model->status) {
                    'completed' => 'Recharge successful',
                    'pending' => 'Recharge pending',
                    'failed' => 'Recharge failed',
                },

                'content' => match($model->status) {
                    'completed' => "You have successfully recharged {$model->money} VND.",
                    'pending' => "Your recharge of {$model->money} VND is being processed.",
                    'failed' => "Recharge of {$model->money} VND failed. Please try again.",
                },
            ];
        }

        return [];
    }
}
