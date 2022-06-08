<?php

namespace App\Observers;

use App\Contracts\CanHaveRoles;
use App\Enums\RoleType;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        if (new User instanceof CanHaveRoles) {
            if ($user->email === env('ADMIN_EMAIL')) {
                $user->assignRole(RoleType::Admin);
            } else $user->assignRole(); // default user role
        }
    }
}
