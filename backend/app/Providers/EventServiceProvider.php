<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Listeners\SendPayBillNotification;
use App\Listeners\SendPostNotification;
use App\Listeners\SendRechargeBillNotification;
use App\Listeners\SendStatusPostNotification;
use App\Models\Payments\PayBill;
use App\Models\Payments\RechargeBill;
use App\Models\Posts\Post;
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
            SendPayBillNotification::class,
        ],
        RechargeBill::class => [
            SendRechargeBillNotification::class,
        ],
        Post::class => [
            SendStatusPostNotification::class,
        ]
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
