<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClientCategory;
use Illuminate\Http\JsonResponse;

class ClientCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = ClientCategory::where('is_active', true)->orderBy('order')->get();

        return response()->json($categories);
    }
}
