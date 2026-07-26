<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection4Page extends Model
{
    protected $fillable = ['year', 'title', 'description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
