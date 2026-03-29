<?php

namespace App\Policies;

use App\Models\Account_User\Account;
use App\Models\Posts\Post;
use Illuminate\Auth\Access\Response;



class PostPolicy
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
    public function view(Account $account, Post $post): bool
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
    public function update(Account $account, Post $post): bool
    {
        // Owner
        return $account->user && $account->user->id === $post->user_id
            || $account->hasRole('postManager');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, Post $post): bool
    {
        // Owner
        return $account->user && $account->user->id === $post->user_id
            || $account->hasRole('postManager');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, Post $post): bool
    {
        // Owner
        return $account->hasRole('postManager');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, Post $post): bool
    {
        return false;
    }
}
