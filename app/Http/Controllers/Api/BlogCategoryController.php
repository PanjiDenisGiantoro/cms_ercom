<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;

class BlogCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('order')->get();

        return response()->json($categories);
    }
}
