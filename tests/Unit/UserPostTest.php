<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\FactoryGeneratedUser;
use function route;

class UserPostTest extends TestCase
{
    use RefreshDatabase, WithFaker, FactoryGeneratedUser;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * A user can create a post.
     *
     * @return void
     */
    public function test_that_user_can_create_a_post()
    {
        $user = $this->getUser();

        $this->actingAs($user)
            ->post(route('post.store'), [
                'title' => $title = $this->faker->sentence(2),
                'description' => $this->faker->text,
            ]);

        $this->assertDatabaseHas('posts', ['title' => $title]);
    }

    /**
     * A user can have many posts.
     *
     * @return void
     */
    public function test_that_user_can_have_many_posts()
    {
        $posts = Post::factory()
            ->count($number = 3)
            ->for(User::factory()->has(Role::factory()))
            ->create();

        $this->assertEquals($posts->count(), $number);
    }

    /**
     * A blog post creation must be validated.
     *
     * @return void
     */
    public function test_that_a_blog_must_pass_validation_to_be_created()
    {
        $user = $this->getUser();

        $response = $this->actingAs($user)
            ->withExceptionHandling()
            ->post(route('post.store'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'description']);
    }
}
