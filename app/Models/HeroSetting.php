<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSetting extends Model
{
    protected $table = 'hero_settings';

    public const TYPES = ['home', 'about', 'highlight', 'contact', 'career', 'service', 'client', 'team'];

    protected $fillable = [
        'type', 'headline', 'highlighted_word', 'subheadline',
        'background_image', 'cta_text', 'cta_url', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['background_image_url'];

    public static function instance(string $type = 'home'): static
    {
        return static::firstOrCreate(['type' => $type]);
    }

    protected function backgroundImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->background_image ? Storage::url($this->background_image) : null);
    }
}
