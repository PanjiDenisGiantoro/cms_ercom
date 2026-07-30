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
            ->orderBy('updated_at', 'desc')
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
        $data['background_image'] = $this->resolveUpload($request, 'background_image', 'hero');

        $hero = HeroSetting::create($data);

        if ($hero->is_active) {
            $this->deactivateSiblings($hero);
        }

        return redirect()->route('admin.hero.index')->with('success', 'Hero created.');
    }

    public function edit(HeroSetting $hero): View
    {
        return view('admin.hero.edit', ['hero' => $hero, 'types' => HeroSetting::TYPES]);
    }

    public function update(Request $request, HeroSetting $hero): RedirectResponse
    {
        $data = $this->validated($request);
        $this->applyUpload($data, $request, 'background_image', 'hero');

        $hero->update($data);

        if ($hero->is_active) {
            $this->deactivateSiblings($hero);
        }

        return redirect()->route('admin.hero.index')->with('success', 'Hero updated.');
    }

    /**
     * Only one Hero can be active per type — activating one deactivates any
     * other active hero of the same type.
     */
    private function deactivateSiblings(HeroSetting $hero): void
    {
        HeroSetting::where('type', $hero->type)
            ->where('id', '!=', $hero->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);
    }

    public function destroy(HeroSetting $hero): RedirectResponse
    {
        $hero->delete();

        return back()->with('success', 'Hero deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type' => 'required|in:'.implode(',', HeroSetting::TYPES),
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string',
            'background_image' => 'nullable',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
