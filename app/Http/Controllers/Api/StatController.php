<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\JsonResponse;

class StatController extends Controller
{
    public function index(): JsonResponse
    {
        $stats = Stat::where('is_active', true)
            ->orderBy('order')
            ->get();

        return response()->json($stats);
    }

    public function show(int $id): JsonResponse
    {
        $stat = Stat::where('is_active', true)->findOrFail($id);

        return response()->json($stat);
    }
}
