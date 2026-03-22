<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Account_User\User;

class UserPolicy
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
    public function viewAny(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Account $account, User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Account $account, User $user): bool
    {
        // Owner
        return $account->id === $user->account_id
            || $account->hasRole('userManager');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account,  User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, User $user): bool
    {
        return false;
    }
}
