<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;

class AboutSection4Page extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'about';

    protected $fillable = ['year', 'title', 'description', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
