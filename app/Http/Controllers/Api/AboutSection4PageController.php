<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutSection4Page;
use Illuminate\Http\JsonResponse;

class AboutSection4PageController extends Controller
{
    public function index(): JsonResponse
    {
        $pages = AboutSection4Page::where('is_active', true)->orderBy('order')->get();

        return response()->json($pages);
    }

    public function show(int $id): JsonResponse
    {
        $page = AboutSection4Page::where('is_active', true)->findOrFail($id);

        return response()->json($page);
    }
}
