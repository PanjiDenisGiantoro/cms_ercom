<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;

class AboutSection3Setting extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'about';

    protected $table = 'about_section3_settings';

    protected $fillable = ['title', 'description'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
