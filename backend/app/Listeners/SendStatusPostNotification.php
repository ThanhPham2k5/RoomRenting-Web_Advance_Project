<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\StatusPostCreated;
use App\Models\Notification\Notification;
use App\Models\Posts\Post;

class SendStatusPostNotification
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
    public function handle(StatusPostCreated $event): void
    {
        $post = $event->post;
        $account = $event->post->user->account;

        Notification::create([
                'title' => $event->title ?? 'Cập nhập bài đăng',
                'content' => $event->content ?? "Bài đăng của bạn đã được cập nhật.",
                'notification_type' => 'news',
                'status' => 'unread',
                'account_id' => $account->id,
                'notifiable_id' => $event->post->id,
                'notifiable_type' => Post::class,
            ]);

        // if ($post['status'] === 'rejected') {
        //     Notification::create([
        //         'title' => 'Bài đăng bị từ chối',
        //         'content' => $event->comment ?? "Bài đăng của bạn đã bị từ chối.",
        //         'notification_type' => 'news',
        //         'status' => 'unread',
        //         'account_id' => $account->id,
        //         'notifiable_id' => $event->post->id,
        //         'notifiable_type' => Post::class,
        //     ]);
        // } else if ($post['status'] === 'completed') {
        //     Notification::create([
        //         'title' => 'Bài đăng đã được duyệt',
        //         'content' => $event->comment ?? "Bài đăng của bạn đã được duyệt.",
        //         'notification_type' => 'news',
        //         'status' => 'unread',
        //         'account_id' => $account->id,
        //         'notifiable_id' => $event->post->id,
        //         'notifiable_type' => Post::class,
        //     ]);
        // } else if ($post['status'] === 'pending') {
        //     Notification::create([
        //         'title' => 'Bài đăng đang được xét duyệt.',
        //         'content' => $event->comment ?? 'Bài đăng #' . $event->post->id . ' đang được duyệt.',
        //         'notification_type' => 'news',
        //         'status' => 'unread',
        //         'account_id' => $account->id,
        //         'notifiable_id' => $event->post->id,
        //         'notifiable_type' => Post::class,
        //     ]);
        // } else if ($post['status'] === 'failed'){
        //     Notification::create([
        //         'title' => 'Bài đăng đã bị từ chối.',
        //         'content' => $event->comment ?? 'Bài đăng #' . $event->post->id . ' đã bị từ chối.',
        //         'notification_type' => 'news',
        //         'status' => 'unread',
        //         'account_id' => $account->id,
        //         'notifiable_id' => $event->post->id,
        //         'notifiable_type' => Post::class,
        //     ]);
        // }
    }
}
