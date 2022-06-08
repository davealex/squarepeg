<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\Caching\DataCacheIndexer;

class PostObserver
{
    /**
     * Handle the Post "creating" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->publication_date = now();
    }

    /**
     * Handle the Post "created" event.
     *
     * @param Post $post
     * @return void
     */
    public function created(Post $post)
    {
        $this->updateDataCacheTrackingIndex();
    }

    /**
     * @return void
     */
    private function updateDataCacheTrackingIndex(): void
    {
        $dataCacheIndexer = new DataCacheIndexer;
        $currentIndex = $dataCacheIndexer->currentIndex;
        $dataCacheIndexer->setDataIndex($currentIndex++, );
    }
}
