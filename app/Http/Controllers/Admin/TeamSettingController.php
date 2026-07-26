<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamSettingController extends Controller
{
    public function edit(): View
    {
        $setting = TeamSetting::instance();

        return view('admin.team-settings.edit', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'headline' => 'nullable|string|max:255',
            'subtext' => 'nullable|string',
        ]);

        TeamSetting::instance()->update($data);

        return back()->with('success', 'Team config updated.');
    }
}
