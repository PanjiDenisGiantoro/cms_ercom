<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'services';

    protected $table = 'service_settings';

    protected $fillable = ['headline', 'subtext'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
