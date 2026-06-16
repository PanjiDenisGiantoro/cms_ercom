<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = ['logo_light_url', 'logo_dark_url'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }

    protected function logoLightUrl(): Attribute
    {
        return Attribute::get(fn () => $this->logo_light ? Storage::url($this->logo_light) : null);
    }

    protected function logoDarkUrl(): Attribute
    {
        return Attribute::get(fn () => $this->logo_dark ? Storage::url($this->logo_dark) : null);
    }
}
