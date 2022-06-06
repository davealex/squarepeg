<?php

namespace App\Http\Controllers;

use App\Services\Importer\Contracts\Importable;
use Illuminate\Http\Request;

class ImportBlogPosts extends Controller
{
    /**
     * Handle the incoming request.
     * Attempt fetching API blog posts from server.
     *
     * @param Request $request
     * @param Importable $importable
     * @return mixed
     */
    public function __invoke(Request $request, Importable $importable): mixed
    {
        return $importable->fetch()
            ->persist();
    }
}
