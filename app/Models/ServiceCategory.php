<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'services';

    protected $fillable = ['name', 'subtitle', 'slug', 'cover_image', 'order', 'is_active'];

    public function media(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ServiceMedia::class, 'mediable')->orderBy('order');
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->slug ??= Str::slug($model->name);
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }
}
