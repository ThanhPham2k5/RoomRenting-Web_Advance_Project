<?php

namespace Database\Seeders;

use App\Models\Account_User\Employee;
use App\Models\Account_User\User;
use App\Models\Posts\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->shuffle();

        // take only half
        $usersWithPosts = $users->take(ceil($users->count() / 2));

        // only admin + postManager can approve
        $employees = Employee::whereHas('account.roles', function ($q) {
            $q->whereIn('name', ['admin', 'postManager']);
        })->get();

        foreach ($usersWithPosts as $user) {

            // each user has 2–5 posts
            $posts = Post::factory(rand(2, 5))->make();

            foreach ($posts as $post) {

                $post->user_id = $user->id;

                $randomDate = Carbon::now()
                    ->subMonths(rand(0, 24)) 
                    ->subDays(rand(0, 28))
                    ->addHours(rand(0, 23));

                $post->created_at = $randomDate;

                if ($post->status === 'completed') {
                    $post->employee_id = $employees->random()->id;
                    $post->authorized = true;
                }elseif($post->status === 'rejected'){
                    $post->employee_id = $employees->random()->id;
                    $post->authorized = false;
                } else {
                    $post->employee_id = null;
                    $post->authorized = false;
                }

                $post->save();
            }
        }
    }
}
