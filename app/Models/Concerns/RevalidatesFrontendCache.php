<?php

namespace App\Models\Concerns;

use App\Jobs\RevalidateFrontendCache as RevalidateFrontendCacheJob;

trait RevalidatesFrontendCache
{
    protected static function bootRevalidatesFrontendCache(): void
    {
        static::saved(function (self $model): void {
            RevalidateFrontendCacheJob::dispatch($model->frontendCacheTag);
        });

        static::deleted(function (self $model): void {
            RevalidateFrontendCacheJob::dispatch($model->frontendCacheTag);
        });
    }
}
