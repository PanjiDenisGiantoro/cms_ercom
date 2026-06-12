<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Career extends Model
{
    protected $fillable = [
        'title', 'slug', 'employment_type', 'location',
        'description', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->slug ??= Str::slug($model->title);
        });
    }

    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }
}
