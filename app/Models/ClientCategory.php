<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ClientCategory extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'client';

    protected $fillable = ['name', 'slug', 'order', 'is_active'];

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

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'category_id');
    }
}
