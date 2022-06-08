<?php

namespace Tests\Unit;

use App\Enums\RoleType;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tests\Traits\FactoryGeneratedUser;
use function route;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker, FactoryGeneratedUser;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * A user can register.
     *
     * @return void
     */
    public function test_that_user_is_a_model()
    {
        $user = $this->getUser();

        $this->assertInstanceOf(Model::class, $user);
    }
}
