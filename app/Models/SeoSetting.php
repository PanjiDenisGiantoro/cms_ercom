<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'meta_title', 'meta_description', 'og_image', 'ga_tracking_id',
        'keywords', 'custom_script_head', 'custom_script_body',
    ];

    protected $appends = ['og_image_url'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }

    protected function ogImageUrl(): Attribute
    {
        return Attribute::get(fn () => $this->og_image ? Storage::url($this->og_image) : null);
    }
}
