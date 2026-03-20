<?php

namespace App\Providers;

use App\Models\Payments\PayBill;
use App\Models\Payments\RechargeBill;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostCreated::class => [
            SendPostNotification::class,
        ],
        // PostUpdated::class => [
        //     SendPostNotification::class,
        // ],
        PayBill::class => [
            SendPaymentNotification::class,
        ],
        RechargeBill::class => [
            SendRechargeNotification::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
