<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoController extends Controller
{
    public function edit(): View
    {
        $seo = SeoSetting::instance();

        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'ga_tracking_id' => 'nullable|string|max:50',
            'keywords' => 'nullable|string',
            'custom_script_head' => 'nullable|string',
            'custom_script_body' => 'nullable|string',
        ]);

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        SeoSetting::instance()->update($data);

        return back()->with('success', 'SEO settings updated.');
    }
}
