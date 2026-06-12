<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterController extends Controller
{
    public function edit(): View
    {
        $footer = FooterSetting::instance();

        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'cta_headline' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'google_maps_url' => 'nullable|url',
            'useful_links' => 'nullable|array',
            'help_links' => 'nullable|array',
            'social_media' => 'nullable|array',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        FooterSetting::instance()->update($data);

        return back()->with('success', 'Footer updated.');
    }
}
