<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'blog';

    protected $fillable = [
        'blog_category_id', 'title', 'slug', 'cover_image',
        'excerpt', 'content', 'author', 'is_published', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];

    protected $appends = ['cover_image_url'];

    protected function coverImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->cover_image ? Storage::url($this->cover_image) : null);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->slug ??= Str::slug($model->title);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
