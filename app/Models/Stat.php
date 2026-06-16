<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Stat extends Model
{
    protected $fillable = ['stat_number', 'stat_label', 'description', 'avatar_images', 'order', 'is_active'];

    protected $casts = [
        'avatar_images' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['avatar_images_urls'];

    protected function avatarImagesUrls(): Attribute
    {
        return Attribute::get(fn () => collect($this->avatar_images ?? [])
            ->map(fn ($path) => Storage::url($path))
            ->all());
    }
}
