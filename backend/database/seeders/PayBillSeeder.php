<?php

namespace Database\Seeders;

use App\Models\Payments\PayBill;
use App\Models\Payments\PayRule;
use App\Models\Posts\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayBillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::where('status', 'completed')->get(); // active posts
        $rules = PayRule::all();

        foreach ($posts as $post) {

            // get owner account via user
            $accountId = $post->user->account_id;

            // pick a rule
            $rule = $rules->random();

            // simulate billing cycles (1–3 times per post)
            $cycles = rand(1, 3);

            for ($i = 0; $i < $cycles; $i++) {

                $status = collect(['completed', 'pending', 'failed'])
                    ->random();

                PayBill::create([
                    'account_id' => $accountId,
                    'post_id' => $post->id,
                    'pay_rule_id' => $rule->id,

                    // derive points from rule
                    'points' => $rule->points,

                    'status' => $status,

                    'created_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}
