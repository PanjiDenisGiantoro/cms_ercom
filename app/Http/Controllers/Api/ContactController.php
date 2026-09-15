<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\NavbarSetting;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        $contacts = Contact::where('is_active', true)->orderBy('order')->get();
        $navbar = NavbarSetting::instance();

        return response()->json([
            'contacts' => $contacts,
            'whatsapp' => [
                'number' => $navbar->whatsapp_number,
                'default_message' => $navbar->whatsapp_default_message,
            ],
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $contact = Contact::where('is_active', true)->findOrFail($id);

        return response()->json($contact);
    }
}
