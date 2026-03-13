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
        // $comments = Comment::all();
        $recharges = RechargeBill::all();
        $pays = PayBill::all();

        $notifiables = $posts
            // ->concat($comments)
            ->concat($recharges)
            ->concat($pays);

        foreach ($notifiables->random(30) as $model) {
            Notification::factory()
                ->forNotifiable($model)
                ->create();
        }
    }
}
