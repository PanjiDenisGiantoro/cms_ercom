<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'partners';

    protected $fillable = ['name', 'logo_image', 'website_url', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['logo_image_url'];

    protected function logoImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->logo_image ? Storage::url($this->logo_image) : null);
    }
}
