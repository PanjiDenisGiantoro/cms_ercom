<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ServiceCategory::withCount('items')->orderBy('order')->paginate(15);

        return view('admin.services.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:4096',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('services', 'public');
        }

        ServiceCategory::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service category created.');
    }

    public function edit(ServiceCategory $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, ServiceCategory $service): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:4096',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service category updated.');
    }

    public function destroy(ServiceCategory $service): RedirectResponse
    {
        $service->delete();

        return back()->with('success', 'Service category deleted.');
    }
}
