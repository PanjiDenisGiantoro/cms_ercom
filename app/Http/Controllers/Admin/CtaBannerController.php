<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CtaBannerSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CtaBannerController extends Controller
{
    public function edit(): View
    {
        $ctaBanner = CtaBannerSetting::instance();

        return view('admin.cta-banner.edit', compact('ctaBanner'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'headline' => 'nullable|string|max:255',
            'subtext' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url',
            'available_status' => 'nullable|string|max:100',
            'team_avatars' => 'nullable|array',
        ]);

        CtaBannerSetting::instance()->update($data);

        return back()->with('success', 'CTA Banner updated.');
    }
}
