<?php

namespace App\Console\Commands;

use App\Services\Importer\Exceptions\UnsupportedImporterService;
use App\Services\Importer\Factories\ImporterFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportPostsFromSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posts {source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calls an action to import data from specified source.';

    /**
     * Execute the console command.
     *
     * @param ImporterFactory $importerFactory
     * @return int
     */
    public function handle(ImporterFactory $importerFactory): int
    {
        try {
            $importerFactory->configureSource($this->argument('source'))
                ->fetch()
                ->persist();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return 0;
    }
}
