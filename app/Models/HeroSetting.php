<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSetting extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'hero';

    protected $table = 'hero_settings';

    public const TYPES = ['home', 'about', 'highlight', 'career', 'service', 'client', 'team'];

    protected $fillable = [
        'type',
        'headline',
        'subheadline',
        'background_image',
        'cta_text',
        'cta_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['background_image_url', 'background_media_type'];

    /**
     * Return a single active hero for the given type (legacy behaviour).
     */
    public static function instance(string $type = 'home'): static
    {
        return static::where('type', $type)->where('is_active', true)->first()
            ?? static::firstOrCreate(['type' => $type]);
    }

    /**
     * Return all active heroes for the given type.
     *
     * @return Collection<int, static>
     */
    public static function activeByType(string $type = 'home'): Collection
    {
        return static::where('type', $type)
            ->where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    protected function backgroundImageUrl(): Attribute
    {
        return Attribute::get(fn() => $this->background_image ? Storage::url($this->background_image) : null);
    }

    protected function backgroundMediaType(): Attribute
    {
        return Attribute::get(function () {
            if (!$this->background_image) {
                return null;
            }

            $extension = strtolower(pathinfo($this->background_image, PATHINFO_EXTENSION));

            return in_array($extension, ['mp4', 'mov', 'webm', 'ogg']) ? 'video' : 'image';
        });
    }
}
