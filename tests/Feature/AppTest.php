<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppTest extends TestCase
{
    use RefreshDatabase;
    /**
     * The landing page is accessible.
     *
     * @return void
     */
    public function test_the_application_is_running()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
