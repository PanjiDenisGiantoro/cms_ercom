<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamSetting extends Model
{
    protected $table = 'team_settings';

    protected $fillable = ['headline', 'subtext'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
