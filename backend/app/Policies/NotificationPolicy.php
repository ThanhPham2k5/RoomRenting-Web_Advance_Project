<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Notification\Notification;
use Illuminate\Auth\Access\Response;


class NotificationPolicy
{
    public function before(Account $account, $ability)
    {
        if ($account->hasRole('admin')) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Account $account): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Account $account, Notification $notification): bool
    {
        return $account->id === $notification->account_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Account $account): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Account $account, Notification $notification): bool
    {
        return $account->id === $notification->account_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, Notification $notification): bool
    {
        return $account->id === $notification->account_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, Notification $notification): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, Notification $notification): bool
    {
        return false;
    }
}
