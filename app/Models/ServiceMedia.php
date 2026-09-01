<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class ServiceMedia extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'services';

    protected $fillable = [
        'media_type', 'file_path', 'youtube_url', 'thumbnail_path', 'order'
    ];

    protected $appends = ['file_url', 'thumbnail_url'];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function fileUrl(): Attribute
    {
        return Attribute::get(fn () => $this->file_path ? Storage::url($this->file_path) : null);
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::get(fn () => $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null);
    }
}
