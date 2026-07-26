<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $clients = Client::with('category')
            ->where('is_active', true)
            ->when($request->query('category'), function ($query, $categorySlug) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
            })
            ->orderBy('order')
            ->paginate(24);

        return response()->json($clients);
    }

    public function show(int $id): JsonResponse
    {
        $client = Client::with('category')
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json($client);
    }
}
