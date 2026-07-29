<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(): JsonResponse
    {
        $messages = ContactMessage::latest()->paginate(15);

        return response()->json($messages);
    }

    public function show(ContactMessage $contact_message): JsonResponse
    {
        return response()->json($contact_message);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string',
        ]);

        ContactMessage::create($data);

        return response()->json(['message' => 'Message submitted.'], 201);
    }
}
