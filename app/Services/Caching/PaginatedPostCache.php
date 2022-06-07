<?php

namespace App\Services\Caching;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PaginatedPostCache
{
    /**
     * @var array|Application|Request|mixed|string|null
     */
    private mixed $request;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param mixed $filteredPostsQuery
     * @param int $perPage
     * @return mixed
     */
    public function getPosts(mixed $filteredPostsQuery, int $perPage = 10): mixed
    {
        return Cache::remember(
            $this->generateCacheKey(),
            now()->addHour(),
            Post::getPaginatedPosts($filteredPostsQuery, $perPage)
        );
    }

    /**
     * @return mixed
     */
    private function sortQueryParams(): mixed
    {
        $queryParams = $this->request->query();
        ksort($queryParams);

        return $queryParams;
    }

    /**
     * @return string
     */
    private function getFullUrl(): string
    {
        $url = $this->request->url();
        $queryString = http_build_query($this->sortQueryParams());

        return "$url?$queryString";
    }

    /**
     * @return string
     */
    private function generateCacheKey(): string
    {
        return sha1($this->getFullUrl());
    }
}
