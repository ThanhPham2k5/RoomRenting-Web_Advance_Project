<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Posts\Comment;
use Illuminate\Auth\Access\Response;


class CommentPolicy
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
    public function view(Account $account, Comment $comment): bool
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
    public function update(Account $account, Comment $comment): bool
    {
        // Owner
        return $account->id === $comment->account_id
            || $account->hasRole('commentManager');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, Comment $comment): bool
    {
        // Owner
        return $account->id === $comment->account_id
            || $account->hasRole('commentManager');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, Comment $comment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, Comment $comment): bool
    {
        return false;
    }
}
