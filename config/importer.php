<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Importer Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the importer information for each data source to import from. You are free to add more.
    |
    | Sources: "api", "file"
    |
    */

    'sources' => [

        'api' => [
            'url' => [
                'hostname' => env('IMPORTER_API_BASE_URL'),
                'path' => '/posts',
            ],
            'retry' => [
                'times' => 3, // no of retries allowed if error occurs on API server request
                'sleep_milliseconds' => 100,
            ],
        ],

        'file' => [
            // config for potentially using file as data source
        ],
    ],

];
