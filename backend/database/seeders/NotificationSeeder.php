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
                    'completed' => 'Bài đăng đã được duyệt',
                    'pending' => 'Bài đăng đang được xét duyệt.',
                    'expired' => 'Bài đăng bị từ chối.',
                    'failed' => 'Post approval failed',
                    default => 'Post update'
                },

                'content' => match($model->status) {
                    'completed' => "Bài đăng  \"{$model->title}\" đã được duyêt.",
                    'pending' => "Bài đăng  \"{$model->title}\" đang được xét duyệt.",
                    'expired' => "Bài đăng  \"{$model->title}\" bị từ chối.",
                    'failed' => "Bài đăng  \"{$model->title}\" đã thất bại.",
                    default => "Bài đăng  \"{$model->title}\" đã được cập nhật."
                },
            ];
        }

        // PAY BILL
        if ($model instanceof PayBill) {
            return [
                'account_id' => $model->account_id,
                'notification_type' => 'transaction',

                'title' => match($model->status) {
                    'completed' => 'Thanh toán chi phí duy trì bài đăng',
                    'pending' => 'Thanh toán chi phí duy trì bài đăng đang được xử lý',
                    'failed' => 'Thanh toán chi phí duy trì bài đăng thất bại',
                },

                'content' => match($model->status) {
                    'completed' => "Đã trừ: " . $model->points . " điểm.",
                    'pending' => "Trừ: " . $model->points . " điểm đang được xử lý.",
                    'failed' => "Đã trừ: " . $model->points . " điểm. Vui lòng kiểm tra lại số điểm của bạn.",
                },
            ];
        }

        // RECHARGE BILL
        if ($model instanceof RechargeBill) {
            return [
                'account_id' => $model->account_id,
                'notification_type' => 'transaction',

                'title' => match($model->status) {
                    'completed' => 'Hoá đơn nạp điểm',
                    'pending' => 'Nạp tiền đang được xử lý',
                    'failed' => 'Nạp tiền thất bại',
                },

                'content' => match($model->status) {
                    'completed' => "Bạn đã nạp thành công " . number_format($model->total_money, 0, ',', '.') . "VND.",
                    'pending' => "Nạp tiền " . number_format($model->total_money, 0, ',', '.') . "VND đang được xử lý.",
                    'failed' => "Nạp " . number_format($model->total_money, 0, ',', '.') . "VND thất bại. Vui lòng thử lại.",
                },
            ];
        }

        return [];
    }
}
