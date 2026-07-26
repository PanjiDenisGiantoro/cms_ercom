<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection4Item extends Model
{
    protected $fillable = ['year', 'description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
