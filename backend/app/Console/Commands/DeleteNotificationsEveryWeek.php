<?php

namespace App\Console\Commands;

use App\Models\Notification\Notification;
use Illuminate\Console\Command;

class DeleteNotificationsEveryWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-notifications-every-week';

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
        Notification::where('created_at', '<=', now()->subWeek())
            ->where(function ($query) {
                $query->where('status', 'read')
                    ->orWhereNull('status');
            })
            ->forceDelete();
    }
}
