<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamBannerController extends Controller
{
    public function index(): View
    {
        $banners = TeamBanner::orderBy('order')->orderBy('updated_at', 'desc')->paginate(15);
        return view('admin.team-banner.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.team-banner.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['image'] = $this->resolveUpload($request, 'image', 'team');

        TeamBanner::create($data);

        return redirect()->route('admin.team-banners.index')->with('success', 'Banner created.');
    }

    public function edit(TeamBanner $teamBanner): View
    {
        return view('admin.team-banner.edit', compact('teamBanner'));
    }

    public function update(Request $request, TeamBanner $teamBanner): RedirectResponse
    {
        $data = $this->validated($request);
        $this->applyUpload($data, $request, 'image', 'team');

        $teamBanner->update($data);

        return redirect()->route('admin.team-banners.index')->with('success', 'Banner updated.');
    }

    public function destroy(TeamBanner $teamBanner): RedirectResponse
    {
        $teamBanner->delete();
        return back()->with('success', 'Banner deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'image' => 'nullable',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
