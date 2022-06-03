<?php

namespace App\Traits;

use App\Contracts\CanHaveRoles;
use App\Enums\RoleType;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * implementing class can have roles.
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @param RoleType|null $role
     * @return void
     */
    public function assignRole(?RoleType $role = null)
    {
        $role = Role::whereTitle($role?->value ?: 'user')->firstOrFail();

        $this->roles()->sync($role, false);
    }

    /**
     * @param RoleType $role
     * @return bool
     */
    public function hasRole(RoleType $role): bool
    {
        if (! ($this instanceof CanHaveRoles)) {
            return true; // skip gate check
        }

        return $this->roles->pluck('title')->contains($role->value);
    }
}
