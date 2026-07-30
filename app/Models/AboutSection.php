<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'about';

    protected $fillable = ['title', 'description', 'icon', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
