<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $blogs = Blog::with('category')
            ->where('is_published', true)
            ->when($request->query('category'), function ($query, $categorySlug) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
            })
            ->latest('published_at')
            ->paginate(12);

        return response()->json($blogs);
    }

    public function show(string $slug): JsonResponse
    {
        $blog = Blog::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return response()->json($blog);
    }
}
