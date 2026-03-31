<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register commands
     */
    protected $commands = [
        \App\Console\Commands\DeductMonthlyPostFee::class,
        \App\Console\Commands\DeleteNotificationsEveryWeek::class,
    ];

    /**
     * Scheduler
     */
    protected function schedule(Schedule $schedule)
    {   
        // set every minute for testting
        $schedule->command('app:deduct-monthly-post-fee')->everyMinute();
        $schedule->command('app:delete-notifications-every-week')->everyMinute();
    }

    /**
     * Load commands
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}