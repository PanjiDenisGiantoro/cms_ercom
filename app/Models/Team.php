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

    protected $fillable = ['name', 'position', 'whatsapp', 'email', 'photo', 'photo_silhouette', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['photo_url', 'photo_silhouette_url'];

    protected function photoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->photo ? Storage::url($this->photo) : null);
    }

    protected function photoSilhouetteUrl(): Attribute
    {
        return Attribute::get(fn () => $this->photo_silhouette ? Storage::url($this->photo_silhouette) : null);
    }
}
