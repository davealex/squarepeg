<?php

namespace Tests\Unit;

use App\Jobs\ProcessPayload;
use App\Models\Payload;
use App\Models\Post;
use App\Services\Importer\Exceptions\UnsupportedImporterService;
use App\Services\Importer\Implementations\ApiImporter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\Traits\FactoryGeneratedUser;

class PostImporterTest extends TestCase
{
    use RefreshDatabase, WithFaker, FactoryGeneratedUser;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * Importer module has a default data source parameter.
     *
     * @return void
     */
    public function test_that_the_importer_command_works()
    {
        $this->artisan('import:posts')
            ->assertExitCode(0);
    }

    /**
     * Importer module will not work with unsupported source.
     *
     * @return void
     */
    public function test_that_the_importer_command_only_allows_supported_sources()
    {
//        $this->withoutExceptionHandling();
//        $this->expectException(UnsupportedImporterService::class);
//        $this->artisan('import:posts testing');

        $this->artisan('import:posts testing')
            ->assertExitCode(0);
    }

    /**
     * Importer module can fetch data from server and process with queue.
     *
     * @return void
     */
    public function test_that_posts_are_fetched_and_processed()
    {
        $post = Post::factory()->make();
        Http::fake([(new ApiImporter)->url => Http::response([
                'title' => $post->title,
                'description' => $post->description
            ]),
        ]);

        Queue::fake();
        $this->artisan('import:posts')
            ->assertExitCode(0);
        Queue::assertPushed(ProcessPayload::class);
    }
}
