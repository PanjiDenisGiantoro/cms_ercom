<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    protected $table = 'hero_settings';

    protected $fillable = [
        'headline', 'highlighted_word', 'subheadline',
        'background_image', 'cta_text', 'cta_url',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
