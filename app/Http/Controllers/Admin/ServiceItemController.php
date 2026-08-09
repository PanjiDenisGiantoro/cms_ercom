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
    /**
     * Maximum number of items per service category that can be flagged as
     * selected/featured for the frontend.
     */
    private const MAX_SELECTED = 4;

    public function index(ServiceCategory $service): View
    {
        $items = $service->items()->withCount('subItems')->orderBy('updated_at', 'desc')->paginate(15);

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
            'thumbnail' => 'nullable',
            'video_file' => 'nullable',
            'preview_video' => 'nullable|url',
            'description' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data['service_category_id'] = $service->id;
        $data['thumbnail'] = $this->resolveUpload($request, 'thumbnail', 'services/items');

        if ($videoFile = $this->resolveUpload($request, 'video_file', 'services/videos')) {
            $data['preview_video'] = $videoFile;
        }

        unset($data['video_file']);

        if (empty($data['thumbnail'])) {
            $data['thumbnail'] = $this->resolveVideoThumbnail($data['preview_video'] ?? null);
        }

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
            'thumbnail' => 'nullable',
            'video_file' => 'nullable',
            'preview_video' => 'nullable|url',
            'description' => 'nullable|string',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $this->applyUpload($data, $request, 'thumbnail', 'services/items');

        if ($videoFile = $this->resolveUpload($request, 'video_file', 'services/videos')) {
            $data['preview_video'] = $videoFile;
        }

        unset($data['video_file']);

        if (($data['thumbnail'] ?? $item->thumbnail) === null) {
            $data['thumbnail'] = $this->resolveVideoThumbnail($data['preview_video'] ?? $item->preview_video);
        }

        $item->update($data);

        return redirect()->route('admin.services.items.index', $service)->with('success', 'Service item updated.');
    }

    public function destroy(ServiceCategory $service, ServiceItem $item): RedirectResponse
    {
        $item->delete();

        return back()->with('success', 'Service item deleted.');
    }

    public function toggleSelected(ServiceCategory $service, ServiceItem $item): RedirectResponse
    {
        if ($item->is_selected) {
            $item->update(['is_selected' => false]);

            return back()->with('success', 'Item dibatalkan dari pilihan.');
        }

        $selectedCount = $service->items()->where('is_selected', true)->count();

        if ($selectedCount >= self::MAX_SELECTED) {
            return back()->with('error', 'Maksimal '.self::MAX_SELECTED.' item yang bisa dipilih untuk ditampilkan di frontend.');
        }

        $item->update(['is_selected' => true]);

        return back()->with('success', 'Item dipilih untuk ditampilkan di frontend.');
    }
}
