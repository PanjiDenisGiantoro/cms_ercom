<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use App\Models\NavbarSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialSettingController extends Controller
{
    public function edit(): View
    {
        $navbar = NavbarSetting::instance();
        $footer = FooterSetting::instance();

        return view('admin.social.edit', compact('navbar', 'footer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'whatsapp_number' => 'nullable|string|max:20',
            'social_media' => 'nullable|array',
            'social_media.*.label' => 'nullable|string|max:50',
            'social_media.*.icon' => 'nullable|string|max:40',
            'social_media.*.url' => 'nullable|url',
        ]);

        NavbarSetting::instance()->update([
            'whatsapp_number' => $data['whatsapp_number'] ?? null,
        ]);

        FooterSetting::instance()->update([
            'social_media' => $data['social_media'] ?? [],
        ]);

        return back()->with('success', 'Social media & WhatsApp settings updated.');
    }
}
