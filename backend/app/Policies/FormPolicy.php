<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use Illuminate\Auth\Access\Response;
use App\Models\Form;
use App\Models\User;

class FormPolicy
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
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Account $account, Form $form): bool
    {
        // Owner
        return $account->id === $form->account_id;
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
    public function update(Account $account, Form $form): bool
    {
        // Owner
        return $account->id === $form->account_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, Form $form): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, Form $form): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, Form $form): bool
    {
        return false;
    }
}
