<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return response()->json($testimonials);
    }

    public function show(int $id): JsonResponse
    {
        $testimonial = Testimonial::where('is_active', true)
            ->findOrFail($id);

        return response()->json($testimonial);
    }
}
