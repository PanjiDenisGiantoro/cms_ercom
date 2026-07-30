<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CtaBannerSetting extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'cta-banner';

    protected $table = 'cta_banner_settings';

    protected $fillable = [
        'headline', 'subtext', 'button_text', 'button_url', 'available_status', 'team_avatars',
    ];

    protected $casts = [
        'team_avatars' => 'array',
    ];

    protected $appends = ['team_avatars_urls'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }

    protected function teamAvatarsUrls(): Attribute
    {
        return Attribute::get(fn () => collect($this->team_avatars ?? [])
            ->map(fn ($path) => Storage::url($path))
            ->all());
    }
}
