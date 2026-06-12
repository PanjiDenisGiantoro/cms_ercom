<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(): JsonResponse
    {
        $careers = Career::where('is_active', true)->orderBy('order')->get();

        return response()->json($careers);
    }

    public function show(string $slug): JsonResponse
    {
        $career = Career::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json($career);
    }

    public function apply(Request $request, string $slug): JsonResponse
    {
        $career = Career::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $data = $request->validate([
            'email' => 'required|email|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $data['cv'] = $request->file('cv')->store('career-applications', 'public');

        $career->applications()->create($data);

        return response()->json(['message' => 'Application submitted.'], 201);
    }
}
