<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Payments\PayBill;
use Illuminate\Auth\Access\Response;


class PayBillPolicy
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
        return $account->hasRole('billManager');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Account $account, PayBill $payBill): bool
    {
        // Owner
        return $account->id === $payBill->account_id
            || $account->hasRole('billManager');
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
    public function update(Account $account, PayBill $payBill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, PayBill $payBill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, PayBill $payBill): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, PayBill $payBill): bool
    {
        return false;
    }
}
