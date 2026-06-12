<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $table = 'footer_settings';

    protected $fillable = [
        'cta_headline', 'address', 'phone_number', 'email',
        'google_maps_url', 'useful_links', 'help_links', 'social_media', 'copyright_text',
    ];

    protected $casts = [
        'useful_links' => 'array',
        'help_links' => 'array',
        'social_media' => 'array',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
