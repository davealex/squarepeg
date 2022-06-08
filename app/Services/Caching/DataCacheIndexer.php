<?php

namespace App\Services\Caching;

use Illuminate\Support\Facades\Cache;

class DataCacheIndexer
{
    /**
     * @var int
     */
    public int $currentIndex;

    public function __construct()
    {
        $this->currentIndex = $this->getDataIndex();
    }

    /**
     * @return mixed
     */
    public function getDataIndex(): mixed
    {
        return Cache::rememberForever('dataIndex', function () {
            return 0;
        });
    }

    public function setDataIndex(int $newValue)
    {
        Cache::forget('dataIndex');

        $this->currentIndex = Cache::rememberForever('dataIndex', function () use ($newValue) {
            return $newValue;
        });
    }
}
