<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\FooterSetting;
use App\Models\NavbarSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function edit(): View
    {
        $contact = Contact::firstOrCreate(['id' => 1], ['label' => 'Kantor Pusat']);
        $navbar = NavbarSetting::instance();
        $footer = FooterSetting::instance();

        return view('admin.contacts.edit', compact('contact', 'navbar', 'footer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'label' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'map_embed_url' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'whatsapp_number' => 'nullable|string|max:20',
            'social_media' => 'nullable|array',
            'social_media.*.label' => 'nullable|string|max:50',
            'social_media.*.icon' => 'nullable|string|max:10',
            'social_media.*.url' => 'nullable|url',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        Contact::updateOrCreate(['id' => 1], [
            'label' => $data['label'] ?? 'Kantor Pusat',
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'map_embed_url' => $data['map_embed_url'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'is_active' => true,
        ]);

        NavbarSetting::instance()->update([
            'whatsapp_number' => $data['whatsapp_number'] ?? null,
        ]);

        FooterSetting::instance()->update([
            'social_media' => $data['social_media'] ?? [],
            'copyright_text' => $data['copyright_text'] ?? null,
        ]);

        return back()->with('success', 'Contact settings updated.');
    }
}
