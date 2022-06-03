<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface CanHaveRoles
{
    /**
     * implementing class can have roles.
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;
}
