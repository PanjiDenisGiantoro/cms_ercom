<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    protected $table = 'service_settings';

    protected $fillable = ['headline', 'subtext'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
