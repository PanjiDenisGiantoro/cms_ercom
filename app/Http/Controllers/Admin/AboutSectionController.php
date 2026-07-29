<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutSectionController extends Controller
{
    public function index(): View
    {
        $sections = AboutSection::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.about-sections.index', compact('sections'));
    }

    public function create(): View
    {
        return view('admin.about-sections.create');
    }

    public function store(Request $request): RedirectResponse
    {
        AboutSection::create($this->validated($request));

        return redirect()->route('admin.about-sections.index')->with('success', 'Section created.');
    }

    public function edit(AboutSection $about_section): View
    {
        return view('admin.about-sections.edit', ['section' => $about_section]);
    }

    public function update(Request $request, AboutSection $about_section): RedirectResponse
    {
        $about_section->update($this->validated($request));

        return redirect()->route('admin.about-sections.index')->with('success', 'Section updated.');
    }

    public function destroy(AboutSection $about_section): RedirectResponse
    {
        $about_section->delete();

        return back()->with('success', 'Section deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
