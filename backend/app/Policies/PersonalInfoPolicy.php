<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use Illuminate\Auth\Access\Response;


class PersonalInfoPolicy
{
    public function before(Account $account, $ability)
    {
        if ($account->hasRole('admin')) {
            return true;
        }
    }

    private function owns(Account $account, PersonalInfo $personalInfo)
    {
        return 
            optional($account->user)->personal_info_id === $personalInfo->id
            || optional($account->employee)->personal_info_id === $personalInfo->id;
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
    public function view(Account $account, PersonalInfo $personalInfo): bool
    {
        return $this->owns($account, $personalInfo);
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
    public function update(Account $account, PersonalInfo $personalInfo): bool
    {
        return $this->owns($account, $personalInfo);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, PersonalInfo $personalInfo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, PersonalInfo $personalInfo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, PersonalInfo $personalInfo): bool
    {
        return false;
    }
}
