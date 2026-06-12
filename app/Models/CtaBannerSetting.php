<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtaBannerSetting extends Model
{
    protected $table = 'cta_banner_settings';

    protected $fillable = [
        'headline', 'subtext', 'button_text', 'button_url', 'available_status', 'team_avatars',
    ];

    protected $casts = [
        'team_avatars' => 'array',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
