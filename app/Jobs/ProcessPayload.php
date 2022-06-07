<?php

namespace App\Jobs;

use App\Models\Payload;
use App\Services\Importer\Actions\MigratePayloadData;
use App\Services\Importer\Exceptions\AdminNotFound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPayload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Payload
     */
    private Payload $payload;

    /**
     * @var int
     */
    private int $completedQueryCounter = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Payload $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws AdminNotFound
     */
    public function handle()
    {
        (new MigratePayloadData($this->payload))->process();
    }
}
