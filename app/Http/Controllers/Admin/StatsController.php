<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatsController extends Controller
{
    public function index(): View
    {
        $stats = Stat::orderBy('order')->paginate(15);

        return view('admin.stats.index', compact('stats'));
    }

    public function create(): View
    {
        return view('admin.stats.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'stat_number' => 'required|string|max:50',
            'stat_label' => 'required|string|max:100',
            'description' => 'nullable|string',
            'avatar_images' => 'nullable|array',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $this->applyMultipleUploads($data, $request, 'avatar_images', 'stats');

        Stat::create($data);

        return redirect()->route('admin.stats.index')->with('success', 'Stat created.');
    }

    public function edit(Stat $stat): View
    {
        return view('admin.stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat): RedirectResponse
    {
        $data = $request->validate([
            'stat_number' => 'required|string|max:50',
            'stat_label' => 'required|string|max:100',
            'description' => 'nullable|string',
            'avatar_images' => 'nullable|array',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $this->applyMultipleUploads($data, $request, 'avatar_images', 'stats');

        $stat->update($data);

        return redirect()->route('admin.stats.index')->with('success', 'Stat updated.');
    }

    public function destroy(Stat $stat): RedirectResponse
    {
        $stat->delete();

        return back()->with('success', 'Stat deleted.');
    }
}
