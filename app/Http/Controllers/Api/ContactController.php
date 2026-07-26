<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        $contacts = Contact::where('is_active', true)->orderBy('order')->get();

        return response()->json($contacts);
    }

    public function show(int $id): JsonResponse
    {
        $contact = Contact::where('is_active', true)->findOrFail($id);

        return response()->json($contact);
    }
}
