<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use App\Models\Posts\Favorite;
use App\Models\Posts\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // only normal users
        $accounts = Account::role('user')->pluck('id');
        $posts = Post::where('status', 'completed')->pluck('id'); // only approved post

        $favorites = [];

        foreach ($accounts as $account) {

            // 0–8 favorites
            $count = rand(0, 8);

            if ($count === 0) continue;

            // pick random posts (no duplicates automatically)
            $randomPosts = $posts->random(min($count, $posts->count()));

            foreach ($randomPosts as $post) {
                $favorites[] = [
                    'account_id' => $account,
                    'post_id' => $post,
                    'created_at' => now()->subDays(rand(0, 10)),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('favorites')->insert($favorites);
    }
}
