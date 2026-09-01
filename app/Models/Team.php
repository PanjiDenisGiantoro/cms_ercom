<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'team';

    protected $fillable = ['name', 'position', 'whatsapp', 'email', 'photo', 'photo_silhouette', 'background_image', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['photo_url', 'photo_silhouette_url', 'background_image_url'];

    protected function photoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->photo ? Storage::url($this->photo) : null);
    }

    protected function photoSilhouetteUrl(): Attribute
    {
        return Attribute::get(fn () => $this->photo_silhouette ? Storage::url($this->photo_silhouette) : null);
    }

    protected function backgroundImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->background_image ? Storage::url($this->background_image) : null);
    }
}
