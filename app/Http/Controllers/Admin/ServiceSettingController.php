<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceSettingController extends Controller
{
    public function edit(): View
    {
        $setting = ServiceSetting::instance();

        return view('admin.service-settings.edit', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'headline' => 'nullable|string|max:255',
            'subtext' => 'nullable|string',
        ]);

        ServiceSetting::instance()->update($data);

        return back()->with('success', 'Services section updated.');
    }
}
