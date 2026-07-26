<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function edit(): View
    {
        $about = AboutSetting::instance();

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'headline' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        AboutSetting::instance()->update($data);

        return back()->with('success', 'About updated.');
    }
}
