<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::where('status', 'completed')->get(); // only approved posts
        $accounts = Account::role('user')->get(); // only users comment

        foreach ($posts as $post) {

            // each post: 0–10 comments
            $totalComments = rand(0, 10);

            if ($totalComments === 0) continue;

            // pick random users who will comment
            $commenters = $accounts->random(min($accounts->count(), rand(1, 5)));

            $created = 0;

            foreach ($commenters as $account) {

                if ($created >= $totalComments) break;

                // each user: 1–3 comments on THIS post
                $count = rand(1, 3);

                for ($i = 0; $i < $count; $i++) {

                    if ($created >= $totalComments) break;

                    Comment::create([
                        'content' => Comment::factory()->make()->content,
                        'account_id' => $account->id,
                        'post_id' => $post->id,
                    ]);

                    $created++;
                }
            }
        }
    }
}
