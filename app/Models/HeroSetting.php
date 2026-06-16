<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSetting extends Model
{
    protected $table = 'hero_settings';

    protected $fillable = [
        'headline', 'highlighted_word', 'subheadline',
        'background_image', 'cta_text', 'cta_url',
    ];

    protected $appends = ['background_image_url'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }

    protected function backgroundImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->background_image ? Storage::url($this->background_image) : null);
    }
}
