<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceSubItem extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'services';

    protected $fillable = [
        'service_item_id', 'name', 'subtitle', 'cover_image', 'thumbnail', 'preview_video', 'description', 'order', 'is_active',
    ];

    public function media(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ServiceMedia::class, 'mediable')->orderBy('order');
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id');
    }
}
