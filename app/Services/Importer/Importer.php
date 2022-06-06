<?php

namespace App\Services\Importer;

use App\Models\Payload;
use App\Services\Importer\Contracts\Importable;

abstract class Importer implements Importable
{
    /**
     * @var string
     */
    protected string $payload;

    /**
     * @return mixed
     */
    abstract public function fetch(): mixed;

    /**
     * @return void
     */
    public function persist(): void
    {
        Payload::stashAway($this->payload);

        if (app()->runningInConsole()) {
            echo 'stashing payload to database complete!';
        }
    }
}
