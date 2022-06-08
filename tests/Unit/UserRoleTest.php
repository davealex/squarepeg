<?php

namespace Tests\Unit;

use App\Enums\RoleType;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\FactoryGeneratedUser;

class UserRoleTest extends TestCase
{
    use RefreshDatabase, WithFaker, FactoryGeneratedUser;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * A user gets assigned a role while registering.
     *
     * @return void
     */
    public function test_that_user_is_automatically_assigned_a_role()
    {
        $user = $this->getUser();

        $this->assertTrue($user->hasRole(RoleType::User));
    }

    /**
     * A role should have a title.
     *
     * @return void
     */
    public function test_that_role_should_have_a_title()
    {
        $role = Role::factory()->create();

        $this->assertNotEmpty($role->title);
    }
}
