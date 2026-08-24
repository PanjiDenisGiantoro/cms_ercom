<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'contact';

    protected $fillable = ['label', 'address', 'phone', 'email', 'map_embed_url', 'latitude', 'longitude', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
