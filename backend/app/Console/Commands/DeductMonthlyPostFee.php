<?php

namespace App\Console\Commands;
use App\Models\Posts\Post;
use App\Services\DeductPostService;

use Illuminate\Console\Command;

class DeductMonthlyPostFee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deduct-monthly-post-fee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Need review this code
        $posts = Post::whereDate('next_payment_date', '<=', today())
        ->whereNotNull('next_payment_date')
        ->where(function ($query) {
            $query->where('status', 'completed')
                  ->orWhere('status', 'expired');
        })
        ->get();

        $service = app(DeductPostService::class);

        foreach ($posts as $post) {
            $service->handle($post);
        }
    }
}
