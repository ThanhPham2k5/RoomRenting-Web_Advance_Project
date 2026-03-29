<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Posts\PostImage;
use Illuminate\Auth\Access\Response;


class PostImagePolicy
{
    private function canModify(Account $account, PostImage $postImage)
    {
        return 
            $account->id === $postImage->post->user_id
            || $account->hasAnyRole(['admin', 'postManager']);
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
    public function view(Account $account, PostImage $postImage): bool
    {
        return false;
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
    public function update(Account $account, PostImage $postImage): bool
    {
        return $this->canModify($account, $postImage);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, PostImage $postImage): bool
    {
        return $this->canModify($account, $postImage);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, PostImage $postImage): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, PostImage $postImage): bool
    {
        return false;
    }
}
