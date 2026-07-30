<?php

namespace App\Models;

use App\Models\Concerns\RevalidatesFrontendCache;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    use RevalidatesFrontendCache;

    protected string $frontendCacheTag = 'testimonials';

    protected $fillable = [
        'name', 'company_role', 'photo', 'testimonial_text', 'rating', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['photo_url'];

    protected function photoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->photo ? Storage::url($this->photo) : null);
    }
}
