<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceItem extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'services';

    protected $fillable = [
        'service_category_id', 'name', 'thumbnail', 'preview_video',
        'description', 'cta_text', 'cta_url', 'order', 'is_active', 'is_selected',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_selected' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function subItems(): HasMany
    {
        return $this->hasMany(ServiceSubItem::class);
    }
}
