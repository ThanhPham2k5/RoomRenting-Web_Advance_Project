<?php

namespace App\Providers;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use App\Models\Account_User\User;
use App\Models\Form;
use App\Models\Notification\Notification;
use App\Models\Payments\PayBill;
use App\Models\Payments\RechargeBill;
use App\Models\Posts\Comment;
use App\Models\Posts\Favorite;
use App\Models\Posts\Post;
use App\Models\Posts\PostImage;
use App\Policies\AccountPolicy;
use App\Policies\CommentPolicy;
use App\Policies\FavoritePolicy;
use App\Policies\FormPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\PayBillPolicy;
use App\Policies\PersonalInfoPolicy;
use App\Policies\PostImagePolicy;
use App\Policies\PostPolicy;
use App\Policies\RechargeBillPolicy;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Post::class => PostPolicy::class,
        PayBill::class => PayBillPolicy::class,
        RechargeBill::class => RechargeBillPolicy::class,
        Comment::class => CommentPolicy::class,
        Form::class => FormPolicy::class,
        Favorite::class => FavoritePolicy::class,
        Notification::class => NotificationPolicy::class,
        PersonalInfo::class => PersonalInfoPolicy::class,
        PostImage::class => PostImagePolicy::class,
        Account::class => AccountPolicy::class,
        User::class => UserPolicy::class
    ];
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
        //
    }
}
