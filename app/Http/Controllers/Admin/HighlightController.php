<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HighlightController extends Controller
{
    public function index(): View
    {
        $highlights = Highlight::orderBy('order')->paginate(15);

        return view('admin.highlights.index', compact('highlights'));
    }

    public function create(): View
    {
        return view('admin.highlights.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $request->file('icon_image')->store('highlights', 'public');
        }

        Highlight::create($data);

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight created.');
    }

    public function edit(Highlight $highlight): View
    {
        return view('admin.highlights.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $request->file('icon_image')->store('highlights', 'public');
        }

        $highlight->update($data);

        return redirect()->route('admin.highlights.index')->with('success', 'Highlight updated.');
    }

    public function destroy(Highlight $highlight): RedirectResponse
    {
        $highlight->delete();

        return back()->with('success', 'Highlight deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
