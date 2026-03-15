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
        // Favorite::factory()->count(80)->create();

        $accounts = Account::pluck('id');
        $posts = Post::pluck('id');

        $favorites = [];

        foreach ($accounts as $account) {

            $randomPosts = $posts->random(rand(1,3));

            foreach ($randomPosts as $post) {
                $favorites[] = [
                    'account_id' => $account,
                    'post_id' => $post,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('favorites')->insert($favorites);
    }
}
