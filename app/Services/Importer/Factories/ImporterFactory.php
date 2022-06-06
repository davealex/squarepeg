<?php

namespace App\Services\Importer\Factories;

use App\Services\Importer\Exceptions\UnsupportedImporterService;
use App\Services\Importer\Implementations\ApiImporter;
use App\Services\Importer\Implementations\FileImporter;

class ImporterFactory
{
    /**
     * @param string
     * @return ApiImporter|FileImporter
     * @throws UnsupportedImporterService
     */
    public function configureSource(string $source): ApiImporter|FileImporter
    {
        return match ($source) {
            'api' => new ApiImporter(),
            'file' => new FileImporter(),
            default => throw new UnsupportedImporterService("The specified importer service [$source] is not currently supported."),
        };
    }
}
