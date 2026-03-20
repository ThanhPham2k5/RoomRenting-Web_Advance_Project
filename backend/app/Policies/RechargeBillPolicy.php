<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Payments\RechargeBill;
use Illuminate\Auth\Access\Response;


class RechargeBillPolicy
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
        // Owner
        return $account->hasRole('bill_manager');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Account $account, RechargeBill $rechargeBill): bool
    {
        // Owner
        return $account->id === $rechargeBill->account_id
            || $account->hasRole('bill_manager');
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
    public function update(Account $account, RechargeBill $rechargeBill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, RechargeBill $rechargeBill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, RechargeBill $rechargeBill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, RechargeBill $rechargeBill): bool
    {
        return false;
    }
}
