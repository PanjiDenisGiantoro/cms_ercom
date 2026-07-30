<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Highlight extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'highlight';

    protected $fillable = ['title', 'description', 'icon_image', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['icon_image_url'];

    protected function iconImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->icon_image ? Storage::url($this->icon_image) : null);
    }
}
