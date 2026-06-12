<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavbarSetting extends Model
{
    protected $table = 'navbar_settings';

    protected $fillable = [
        'logo_light', 'logo_dark', 'menu_items',
        'cta_text', 'cta_url', 'whatsapp_number', 'sticky_on_scroll',
    ];

    protected $casts = [
        'menu_items' => 'array',
        'sticky_on_scroll' => 'boolean',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
