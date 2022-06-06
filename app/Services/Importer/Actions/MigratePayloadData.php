<?php

namespace App\Services\Importer\Actions;

use App\Models\Payload;
use App\Models\User;
use App\Services\Importer\Exceptions\AdminNotFound;
use Illuminate\Support\Facades\Log;

class MigratePayloadData
{
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
     * @return void
     * @throws AdminNotFound
     */
    public function __invoke()
    {
        $this->processPayload();
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws AdminNotFound
     */
    public function processPayload()
    {
        if ($this->adminRecord()->exists()) {
            $admin = $this->adminRecord()->first();

            $this->writeToDatabase($admin)
                ->sanitizePostMigration();

        } else throw new AdminNotFound('System Administrator required to complete process.');
    }

    /**
     * @param $admin
     * @return MigratePayloadData
     */
    private function writeToDatabase($admin): MigratePayloadData
    {
        foreach ($this->payloadData() as $post) {
            try {
                $admin->posts()->firstOrCreate(
                    ['title' => $post['title']],
                    ['description' => $post['description']]
                );

                $this->completedQueryCounter++;

            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    private function allDone(): bool
    {
        return $this->completedQueryCounter === count($this->payloadData());
    }

    /**
     * @return void
     */
    private function sanitizePostMigration(): void
    {
        if ($this->allDone() && $this->payload->delete()) {
            Log::info('Importing Posts Batch Complete.');
        }
    }

    /**
     * @return mixed
     */
    private function adminRecord(): mixed
    {
        return User::where('email', trim(env('ADMIN_EMAIL')));
    }

    /**
     * @return mixed
     */
    private function payloadData(): mixed
    {
        return json_decode($this->payload->response, true)['data'];
    }
}
