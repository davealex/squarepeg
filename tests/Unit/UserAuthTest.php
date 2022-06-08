<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tests\Traits\FactoryGeneratedUser;
use function route;

class UserAuthTest extends TestCase
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
    public function test_that_user_can_register()
    {
        $data = [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'password' => Hash::make($this->faker->password),
        ];

        $this->assertGuest()
            ->post(route('register'), $data);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
    }

    /**
     * A user can login.
     *
     * @return void
     */
    public function test_that_user_can_login()
    {
        $user = $this->getUser();

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertOk();
    }

    /**
     * A user can log out of application.
     *
     * @return void
     */
    public function test_that_user_can_logout()
    {
        $user = $this->getUser();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect('/');
    }

    /**
     * A test auth middleware guarded page.
     *
     * @return void
     */
    public function test_that_guests_cannot_access_an_auth_protected_page()
    {
        $response = $this->assertGuest()->get(route('home'));

        $response->assertRedirect(route('login'));
    }
}
