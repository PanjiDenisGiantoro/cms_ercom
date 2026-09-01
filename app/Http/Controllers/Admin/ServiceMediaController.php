<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\ServiceSubItem;
use App\Models\ServiceMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceMediaController extends Controller
{
    /**
     * Get the parent model (Category, Item, or SubItem)
     */
    private function getParent(string $type, int $id)
    {
        return match ($type) {
            'category' => ServiceCategory::findOrFail($id),
            'item' => ServiceItem::findOrFail($id),
            'subitem' => ServiceSubItem::findOrFail($id),
            default => abort(404),
        };
    }

    public function index(Request $request): View
    {
        $type = $request->query('type');
        $id = $request->query('id');

        $parent = $this->getParent($type, $id);
        $mediaList = $parent->media()->orderBy('order')->paginate(20);

        return view('admin.services.media.index', compact('parent', 'mediaList', 'type', 'id'));
    }

    public function create(Request $request): View
    {
        $type = $request->query('type');
        $id = $request->query('id');
        $parent = $this->getParent($type, $id);

        return view('admin.services.media.create', compact('parent', 'type', 'id'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'mediable_type' => 'required|in:category,item,subitem',
            'mediable_id' => 'required|integer',
            'media_type' => 'required|in:photo,youtube,video',
            'youtube_url' => 'nullable|url',
            'order' => 'integer|min:0',
        ]);

        $parent = $this->getParent($data['mediable_type'], $data['mediable_id']);

        if ($data['media_type'] === 'photo') {
            $paths = $this->resolveMultipleUploads($request, 'file_path', 'services/media');
            if ($paths) {
                foreach ($paths as $path) {
                    $parent->media()->create([
                        'media_type' => 'photo',
                        'file_path' => $path,
                        'order' => $data['order'] ?? 0,
                    ]);
                }
            }
            return redirect()->route('admin.service-media.index', ['type' => $data['mediable_type'], 'id' => $data['mediable_id']])->with('success', 'Media berhasil ditambahkan.');
        }

        if ($data['media_type'] === 'video') {
            $data['file_path'] = $this->resolveUpload($request, 'file_path', 'services/media');
            $data['thumbnail_path'] = $this->resolveUpload($request, 'thumbnail_path', 'services/media');
            if (empty($data['thumbnail_path'])) {
                $data['thumbnail_path'] = $this->resolveVideoThumbnail($data['file_path']);
            }
        } elseif ($data['media_type'] === 'youtube') {
            $data['thumbnail_path'] = $this->resolveUpload($request, 'thumbnail_path', 'services/media');
            if (empty($data['thumbnail_path'])) {
                $data['thumbnail_path'] = $this->resolveVideoThumbnail($data['youtube_url']);
            }
        }

        $parent->media()->create($data);

        return redirect()->route('admin.service-media.index', ['type' => $data['mediable_type'], 'id' => $data['mediable_id']])->with('success', 'Media berhasil ditambahkan.');
    }

    public function edit(ServiceMedia $serviceMedia): View
    {
        $type = null;
        if ($serviceMedia->mediable_type === ServiceCategory::class) $type = 'category';
        elseif ($serviceMedia->mediable_type === ServiceItem::class) $type = 'item';
        elseif ($serviceMedia->mediable_type === ServiceSubItem::class) $type = 'subitem';

        $id = $serviceMedia->mediable_id;
        $parent = $this->getParent($type, $id);

        return view('admin.services.media.edit', compact('serviceMedia', 'parent', 'type', 'id'));
    }

    public function update(Request $request, ServiceMedia $serviceMedia): RedirectResponse
    {
        $data = $request->validate([
            'media_type' => 'required|in:photo,youtube,video',
            'file_path' => 'nullable',
            'youtube_url' => 'nullable|url',
            'thumbnail_path' => 'nullable',
            'order' => 'integer|min:0',
        ]);

        if ($data['media_type'] === 'photo') {
            $this->applyUpload($data, $request, 'file_path', 'services/media');
        } elseif ($data['media_type'] === 'video') {
            $this->applyUpload($data, $request, 'file_path', 'services/media');
            $this->applyUpload($data, $request, 'thumbnail_path', 'services/media');
        } elseif ($data['media_type'] === 'youtube') {
            $this->applyUpload($data, $request, 'thumbnail_path', 'services/media');
            if (($data['thumbnail_path'] ?? $serviceMedia->thumbnail_path) === null) {
                $data['thumbnail_path'] = $this->resolveVideoThumbnail($data['youtube_url'] ?? $serviceMedia->youtube_url);
            }
        }

        $serviceMedia->update($data);

        $type = null;
        if ($serviceMedia->mediable_type === ServiceCategory::class) $type = 'category';
        elseif ($serviceMedia->mediable_type === ServiceItem::class) $type = 'item';
        elseif ($serviceMedia->mediable_type === ServiceSubItem::class) $type = 'subitem';

        return redirect()->route('admin.service-media.index', ['type' => $type, 'id' => $serviceMedia->mediable_id])->with('success', 'Media berhasil diupdate.');
    }

    public function destroy(ServiceMedia $serviceMedia): RedirectResponse
    {
        $serviceMedia->delete();
        return back()->with('success', 'Media berhasil dihapus.');
    }
}
