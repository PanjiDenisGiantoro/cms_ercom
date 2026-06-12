<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'meta_title', 'meta_description', 'og_image', 'ga_tracking_id',
        'keywords', 'custom_script_head', 'custom_script_body',
    ];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
