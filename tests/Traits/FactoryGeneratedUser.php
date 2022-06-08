<?php

namespace Tests\Traits;

use App\Models\Role;
use App\Models\User;

trait FactoryGeneratedUser
{
    /**
     * @return mixed
     */
    private function getUser(): mixed
    {
        return User::factory()
            ->has(Role::factory())
            ->create();
    }
}
