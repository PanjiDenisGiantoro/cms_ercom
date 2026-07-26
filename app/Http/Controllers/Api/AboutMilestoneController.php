<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutMilestone;
use App\Models\AboutSection3Setting;
use Illuminate\Http\JsonResponse;

class AboutMilestoneController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'settings' => AboutSection3Setting::instance(),
            'data' => AboutMilestone::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $milestone = AboutMilestone::where('is_active', true)->findOrFail($id);

        return response()->json($milestone);
    }
}
