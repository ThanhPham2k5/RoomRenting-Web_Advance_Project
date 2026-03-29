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

        if ($post['status'] === 'rejected') {
            Notification::create([
                'title' => 'Bài đăng bị từ chối',
                'content' => $event->comment,
                'notification_type' => 'news',
                'status' => 'unread',
                'account_id' => $account->id,
                'notifiable_id' => $event->post->id,
                'notifiable_type' => Post::class,
            ]);
        } else if ($post['status'] === 'completed') {
            Notification::create([
                'title' => 'Bài đăng đã được duyệt',
                'content' => $event->comment,
                'notification_type' => 'news',
                'status' => 'unread',
                'account_id' => $account->id,
                'notifiable_id' => $event->post->id,
                'notifiable_type' => Post::class,
            ]);
        } else {
            Notification::create([
                'title' => 'Bài đăng đang được xét duyệt.',
                'content' => 'Bài đăng #' . $event->post->id . ' đang được duyệt.',
                'notification_type' => 'news',
                'status' => 'unread',
                'account_id' => $account->id,
                'notifiable_id' => $event->post->id,
                'notifiable_type' => Post::class,
            ]);
        }
    }
}
