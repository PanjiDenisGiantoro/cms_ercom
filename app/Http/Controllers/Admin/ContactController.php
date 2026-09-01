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
        $contacts = collect([
            1 => Contact::firstOrCreate(['id' => 1], ['label' => 'Workshop']),
            2 => Contact::firstOrCreate(['id' => 2], ['label' => 'Head Office'])
        ]);
        $navbar = NavbarSetting::instance();
        $footer = FooterSetting::instance();

        return view('admin.contacts.edit', compact('contacts', 'navbar', 'footer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'contacts' => 'required|array',
            'contacts.*.label' => 'required|string|max:255',
            'contacts.*.address' => 'nullable|string|max:255',
            'contacts.*.phone' => 'nullable|string|max:50',
            'contacts.*.email' => 'nullable|email|max:255',
            'contacts.*.map_embed_url' => 'nullable|string',
            'whatsapp_number' => 'nullable|string|max:20',
            'social_media' => 'nullable|array',
            'social_media.*.label' => 'nullable|string|max:50',
            'social_media.*.icon' => 'nullable|string|max:10',
            'social_media.*.url' => 'nullable|url',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        foreach ($data['contacts'] as $id => $contactData) {
            Contact::updateOrCreate(['id' => $id], [
                'label' => $contactData['label'] ?? 'Kantor',
                'address' => $contactData['address'] ?? null,
                'phone' => $contactData['phone'] ?? null,
                'email' => $contactData['email'] ?? null,
                'map_embed_url' => $contactData['map_embed_url'] ?? null,
                'order' => $id,
                'is_active' => true,
            ]);
        }

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
