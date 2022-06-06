<?php

namespace App\Services\Importer\Contracts;

interface Importable
{
    /**
     * fetch data from source
     * @return mixed
     */
    public function fetch(): mixed;

    /**
     * save data to storage engine
     * @return void
     */
    function persist(): void;
}
