<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'client';

    protected $fillable = ['category_id', 'name', 'logo_image', 'website_url', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['logo_image_url'];

    protected function logoImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->logo_image ? Storage::url($this->logo_image) : null);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ClientCategory::class, 'category_id');
    }
}
