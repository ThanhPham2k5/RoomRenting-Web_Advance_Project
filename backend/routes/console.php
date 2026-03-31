<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// set every minute for testting
Schedule::command('app:deduct-monthly-post-fee')->everyMinute();
Schedule::command('app:delete-notifications-every-week')->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
