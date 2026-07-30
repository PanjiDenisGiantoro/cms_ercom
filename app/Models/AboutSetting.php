<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutSetting extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'about';

    protected $table = 'about_settings';

    protected $fillable = [
        'headline', 'description', 'year_established', 'video_url', 'background_image',
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
