<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection4Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutSection4PageController extends Controller
{
    public function index(): View
    {
        $pages = AboutSection4Page::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.about-section4-pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.about-section4-pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        AboutSection4Page::create($this->validated($request));

        return redirect()->route('admin.about-section4-pages.index')->with('success', 'Page created.');
    }

    public function edit(AboutSection4Page $about_section4_page): View
    {
        return view('admin.about-section4-pages.edit', ['page' => $about_section4_page]);
    }

    public function update(Request $request, AboutSection4Page $about_section4_page): RedirectResponse
    {
        $about_section4_page->update($this->validated($request));

        return redirect()->route('admin.about-section4-pages.index')->with('success', 'Page updated.');
    }

    public function destroy(AboutSection4Page $about_section4_page): RedirectResponse
    {
        $about_section4_page->delete();

        return back()->with('success', 'Page deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'year' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
