<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMilestone extends Model
{
    protected $fillable = ['year', 'headline', 'headline_description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
