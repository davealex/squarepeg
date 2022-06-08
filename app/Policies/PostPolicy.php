<?php

namespace App\Policies;

use App\Enums\RoleType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function edit(User $user, Post $post): bool
    {
//        return $this->actionIsAllowed($user, $post);

        return false;
    }

    /**
     * Determine whether the user can delete models.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function destroy(User $user, Post $post): bool
    {
//        return $this->actionIsAllowed($user, $post);

        return false;
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    private function actionIsAllowed(User $user, Post $post): bool
    {
        return $user->hasRole(RoleType::Admin) || $user->id === $post->user_id;
    }
}
