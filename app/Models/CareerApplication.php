<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerApplication extends Model
{
    protected $fillable = ['career_id', 'name', 'email', 'phone', 'address', 'cv'];

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
