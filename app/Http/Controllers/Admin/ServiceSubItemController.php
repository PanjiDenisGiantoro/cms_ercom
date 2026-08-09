<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\ServiceSubItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceSubItemController extends Controller
{
    public function index(ServiceCategory $service, ServiceItem $item): View
    {
        $subItems = $item->subItems()->orderBy('order')->paginate(15);

        return view('admin.services.items.sub-items.index', compact('service', 'item', 'subItems'));
    }

    public function create(ServiceCategory $service, ServiceItem $item): View
    {
        return view('admin.services.items.sub-items.create', compact('service', 'item'));
    }

    public function store(Request $request, ServiceCategory $service, ServiceItem $item): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable',
            'video_file' => 'nullable',
            'preview_video' => 'nullable|url',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data['service_item_id'] = $item->id;
        $data['thumbnail'] = $this->resolveUpload($request, 'thumbnail', 'services/sub-items');

        if ($videoFile = $this->resolveUpload($request, 'video_file', 'services/videos')) {
            $data['preview_video'] = $videoFile;
        }

        unset($data['video_file']);

        if (empty($data['thumbnail'])) {
            $data['thumbnail'] = $this->resolveVideoThumbnail($data['preview_video'] ?? null);
        }

        $item->subItems()->create($data);

        return redirect()->route('admin.services.items.sub-items.index', [$service, $item])->with('success', 'Sub item created.');
    }

    public function edit(ServiceCategory $service, ServiceItem $item, ServiceSubItem $subItem): View
    {
        return view('admin.services.items.sub-items.edit', compact('service', 'item', 'subItem'));
    }

    public function update(Request $request, ServiceCategory $service, ServiceItem $item, ServiceSubItem $subItem): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable',
            'video_file' => 'nullable',
            'preview_video' => 'nullable|url',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $this->applyUpload($data, $request, 'thumbnail', 'services/sub-items');

        if ($videoFile = $this->resolveUpload($request, 'video_file', 'services/videos')) {
            $data['preview_video'] = $videoFile;
        }

        unset($data['video_file']);

        if (($data['thumbnail'] ?? $subItem->thumbnail) === null) {
            $data['thumbnail'] = $this->resolveVideoThumbnail($data['preview_video'] ?? $subItem->preview_video);
        }

        $subItem->update($data);

        return redirect()->route('admin.services.items.sub-items.index', [$service, $item])->with('success', 'Sub item updated.');
    }

    public function destroy(ServiceCategory $service, ServiceItem $item, ServiceSubItem $subItem): RedirectResponse
    {
        $subItem->delete();

        return back()->with('success', 'Sub item deleted.');
    }
}
