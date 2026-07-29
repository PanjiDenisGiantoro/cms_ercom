<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $applications = CareerApplication::with('career')
            ->when($request->query('career'), function ($query, $careerSlug) {
                $query->whereHas('career', fn ($q) => $q->where('slug', $careerSlug));
            })
            ->latest()
            ->paginate(15);

        return response()->json($applications);
    }

    public function show(CareerApplication $career_application): JsonResponse
    {
        return response()->json($career_application->load('career'));
    }
}
