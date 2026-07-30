<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;

class AboutMilestone extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'about';

    protected $fillable = ['year', 'headline', 'headline_description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
