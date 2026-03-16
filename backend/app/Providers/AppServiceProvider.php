<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'post' => \App\Models\Posts\Post::class,
            'comment' => \App\Models\Posts\Comment::class,
            'pay_bill' => \App\Models\Payments\PayBill::class,
            'recharge_bill' => \App\Models\Payments\RechargeBill::class,
        ]);
    }
}
