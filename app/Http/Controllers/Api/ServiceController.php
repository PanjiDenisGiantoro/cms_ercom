<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceSetting;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'settings' => ServiceSetting::instance(),
            'data' => ServiceCategory::with(['items' => function ($q) {
                $q->where('is_active', true)->orderBy('order');
            }, 'items.subItems' => function ($q) {
                $q->where('is_active', true)->orderBy('order');
            }])
                ->where('is_active', true)
                ->orderBy('order')
                ->get(),
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $category = ServiceCategory::with(['items' => function ($q) {
            $q->where('is_active', true)->orderBy('order');
        }, 'items.subItems' => function ($q) {
            $q->where('is_active', true)->orderBy('order');
        }])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json($category);
    }
}
