<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceItemController extends Controller
{
    public function index(ServiceCategory $service): View
    {
        $items = $service->items()->withCount('subItems')->orderBy('order')->paginate(15);

        return view('admin.services.items.index', compact('service', 'items'));
    }

    public function create(ServiceCategory $service): View
    {
        return view('admin.services.items.create', compact('service'));
    }

    public function store(Request $request, ServiceCategory $service): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:4096',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,webm|max:102400',
            'preview_video' => 'nullable|url',
            'description' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data['service_category_id'] = $service->id;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('services/items', 'public');
        }

        if ($request->hasFile('video_file')) {
            $data['preview_video'] = $request->file('video_file')->store('services/videos', 'public');
        }

        unset($data['video_file']);

        $service->items()->create($data);

        return redirect()->route('admin.services.items.index', $service)->with('success', 'Service item created.');
    }

    public function edit(ServiceCategory $service, ServiceItem $item): View
    {
        return view('admin.services.items.edit', compact('service', 'item'));
    }

    public function update(Request $request, ServiceCategory $service, ServiceItem $item): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:4096',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,webm|max:102400',
            'preview_video' => 'nullable|url',
            'description' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('services/items', 'public');
        }

        if ($request->hasFile('video_file')) {
            $data['preview_video'] = $request->file('video_file')->store('services/videos', 'public');
        }

        unset($data['video_file']);

        $item->update($data);

        return redirect()->route('admin.services.items.index', $service)->with('success', 'Service item updated.');
    }

    public function destroy(ServiceCategory $service, ServiceItem $item): RedirectResponse
    {
        $item->delete();

        return back()->with('success', 'Service item deleted.');
    }
}
