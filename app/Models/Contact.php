<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'contact';

    protected $fillable = ['label', 'address', 'phone', 'email', 'map_embed_url', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
