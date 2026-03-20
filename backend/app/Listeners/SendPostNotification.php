<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostCreated;
use App\Models\Form;
use App\Models\Notification\Notification;
use App\Models\Posts\Post;

class SendPostNotification
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
    public function handle(PostCreated $event)
    {
        $post = $event->post;

        // Get all Forms
        $forms = Form::all();

        foreach ($forms as $form) {

            $match = true;

            if ($form->price_min && $post->price < $form->price_min) {
                $match = false;
            }

            if ($form->price_max && $post->price > $form->price_max) {
                $match = false;
            }

            // area (±20%)
            if ($form->area) {
                $min = $form->area * 0.8;
                $max = $form->area * 1.2;

                if ($post->area < $min || $post->area > $max) {
                    $match = false;
                }
            }

            // location
            if ($form->province && $post->province !== $form->province) {
                $match = false;
            }

            if ($form->ward && stripos($post->ward, $form->ward) === false) {
                $match = false;
            }

            // room type
            if ($form->room_type && $post->room_type !== $form->room_type) {
                $match = false;
            }

            // occupants
            if ($form->max_occupants && $post->max_occupants < $form->max_occupants) {
                $match = false;
            }

            // If all criteria match, create a notification
            if ($match) {
                Notification::create([
                    'title' => 'Có bài đăng mới phù hợp',
                    'content' => 'Bài "' . $post->title . '" phù hợp với nhu cầu của bạn',
                    'account_id' => $form->account_id,
                    'notifiable_id' => $post->id,
                    'notifiable_type' => Post::class,
                ]);
            }
        }
    }
}
