<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection4Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutSection4ItemController extends Controller
{
    public function index(): View
    {
        $items = AboutSection4Item::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.about-section4-items.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.about-section4-items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        AboutSection4Item::create($this->validated($request));

        return redirect()->route('admin.about-section4-items.index')->with('success', 'Item created.');
    }

    public function edit(AboutSection4Item $about_section4_item): View
    {
        return view('admin.about-section4-items.edit', ['item' => $about_section4_item]);
    }

    public function update(Request $request, AboutSection4Item $about_section4_item): RedirectResponse
    {
        $about_section4_item->update($this->validated($request));

        return redirect()->route('admin.about-section4-items.index')->with('success', 'Item updated.');
    }

    public function destroy(AboutSection4Item $about_section4_item): RedirectResponse
    {
        $about_section4_item->delete();

        return back()->with('success', 'Item deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'year' => 'required|string|max:10',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
