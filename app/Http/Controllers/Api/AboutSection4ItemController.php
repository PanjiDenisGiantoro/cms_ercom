<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutSection4Item;
use Illuminate\Http\JsonResponse;

class AboutSection4ItemController extends Controller
{
    public function index(): JsonResponse
    {
        $items = AboutSection4Item::where('is_active', true)->orderBy('order')->get();

        return response()->json($items);
    }

    public function show(int $id): JsonResponse
    {
        $item = AboutSection4Item::where('is_active', true)->findOrFail($id);

        return response()->json($item);
    }
}
