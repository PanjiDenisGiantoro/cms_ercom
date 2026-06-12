<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroController extends Controller
{
    public function edit(): View
    {
        $hero = HeroSetting::instance();

        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'headline' => 'nullable|string|max:255',
            'highlighted_word' => 'nullable|string|max:100',
            'subheadline' => 'nullable|string',
            'background_image' => 'nullable|image|max:4096',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
        ]);

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('hero', 'public');
        }

        HeroSetting::instance()->update($data);

        return back()->with('success', 'Hero updated.');
    }
}
