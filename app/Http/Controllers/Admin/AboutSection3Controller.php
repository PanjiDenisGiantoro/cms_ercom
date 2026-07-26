<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection3Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutSection3Controller extends Controller
{
    public function edit(): View
    {
        $setting = AboutSection3Setting::instance();

        return view('admin.about-section3.edit', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        AboutSection3Setting::instance()->update($data);

        return back()->with('success', 'Section 3 updated.');
    }
}
