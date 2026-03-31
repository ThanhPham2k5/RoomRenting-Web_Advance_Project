<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use Illuminate\Auth\Access\Response;


class AccountPolicy
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
    public function view(Account $account, Account $viewAccount): bool
    {
        return $account->id === $viewAccount->id 
            || $account->hasRole('userManager');
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
    public function update(Account $account, Account $editAccount): bool
    {
        // Owner
        return $account->id === $editAccount->id
            || $account->hasRole('userManager');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, Account $deleteAccount): bool
    {
        return $account->hasRole('userManager');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account,  Account $restoreAccount): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, Account $fdeleteAccount): bool
    {
        return false;
    }
}
