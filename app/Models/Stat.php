<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = ['stat_number', 'stat_label', 'description', 'avatar_images', 'order', 'is_active'];

    protected $casts = [
        'avatar_images' => 'array',
        'is_active' => 'boolean',
    ];
}
