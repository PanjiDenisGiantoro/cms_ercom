<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamSetting;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'settings' => TeamSetting::instance(),
            'data' => Team::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $member = Team::where('is_active', true)->findOrFail($id);

        return response()->json($member);
    }
}
