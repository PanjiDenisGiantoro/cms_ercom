<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->get('type');

        $heroes = HeroSetting::query()
            ->when($type, fn ($query) => $query->where('type', $type))
            ->orderBy('type')
            ->orderBy('order')
            ->paginate(15)
            ->withQueryString();

        return view('admin.hero.index', [
            'heroes' => $heroes,
            'types' => HeroSetting::TYPES,
            'selectedType' => $type,
        ]);
    }

    public function create(): View
    {
        return view('admin.hero.create', ['types' => HeroSetting::TYPES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('hero', 'public');
        }

        HeroSetting::create($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero created.');
    }

    public function edit(HeroSetting $hero): View
    {
        return view('admin.hero.edit', ['hero' => $hero, 'types' => HeroSetting::TYPES]);
    }

    public function update(Request $request, HeroSetting $hero): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero updated.');
    }

    public function destroy(HeroSetting $hero): RedirectResponse
    {
        $hero->delete();

        return back()->with('success', 'Hero deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type' => 'required|in:' . implode(',', HeroSetting::TYPES),
            'headline' => 'nullable|string|max:255',
            'highlighted_word' => 'nullable|string|max:100',
            'subheadline' => 'nullable|string',
            'background_image' => 'nullable|image|max:4096',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
