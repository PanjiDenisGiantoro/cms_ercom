<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection3Setting extends Model
{
    protected $table = 'about_section3_settings';

    protected $fillable = ['title', 'description'];

    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
