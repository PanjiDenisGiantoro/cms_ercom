<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'position', 'photo', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
