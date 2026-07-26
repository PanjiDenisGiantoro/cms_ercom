<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    public function index(): JsonResponse
    {
        $partners = Partner::where('is_active', true)
            ->orderBy('order')
            ->paginate(24);

        return response()->json($partners);
    }

    public function show(int $id): JsonResponse
    {
        $partner = Partner::where('is_active', true)
            ->findOrFail($id);

        return response()->json($partner);
    }
}
