<?php

namespace Database\Factories;

use App\Models\Notification\Notification;
use App\Models\Account_User\Account;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = Post::factory()->create();

        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['read', 'unread']),
            'notification_type' => $this->faker->randomElement(['news', 'transaction']),
            'account_id' => Account::factory(),
            'notifiable_id' => $post->id,
            'notifiable_type' => Post::class,
        ];
    }

    /**
     * Indicate that the notification is read.
     *
     * @return static
     */
    public function read(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'read',
        ]);
    }

    /**
     * Indicate that the notification is unread.
     *
     * @return static
     */
    public function unread(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'unread',
        ]);
    }

    /**
     * Indicate that the notification is a news type.
     *
     * @return static
     */
    public function news(): static
    {
        return $this->state(fn(array $attributes) => [
            'notification_type' => 'news',
        ]);
    }

    /**
     * Indicate that the notification is a transaction type.
     *
     * @return static
     */
    public function transaction(): static
    {
        return $this->state(fn(array $attributes) => [
            'notification_type' => 'transaction',
        ]);
    }

    /**
     * Set the notifiable model (polymorphic).
     *
     * @param mixed $notifiable
     * @return static
     */
    public function forNotifiable($notifiable): static
    {
        return $this->state(fn(array $attributes) => [
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => $notifiable::class,
        ]);
    }
}
