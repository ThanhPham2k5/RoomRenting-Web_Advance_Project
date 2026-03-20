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
    ];

    /**
     * Scheduler
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('deduct:monthly-post-fee')->daily();
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