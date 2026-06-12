<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    public function index(): JsonResponse
    {
        $portfolios = Portfolio::with('category')
            ->where('is_published', true)
            ->latest('project_date')
            ->paginate(12);

        return response()->json($portfolios);
    }

    public function show(string $slug): JsonResponse
    {
        $portfolio = Portfolio::with('category')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return response()->json($portfolio);
    }
}
