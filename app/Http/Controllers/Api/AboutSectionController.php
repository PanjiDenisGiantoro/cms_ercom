<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\JsonResponse;

class AboutSectionController extends Controller
{
    public function index(): JsonResponse
    {
        $sections = AboutSection::where('is_active', true)->orderBy('order')->get();

        return response()->json($sections);
    }

    public function show(int $id): JsonResponse
    {
        $section = AboutSection::where('is_active', true)->findOrFail($id);

        return response()->json($section);
    }
}
