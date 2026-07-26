<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['label', 'address', 'phone', 'email', 'map_embed_url', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}