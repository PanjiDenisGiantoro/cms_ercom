<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMilestone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutMilestoneController extends Controller
{
    public function index(): View
    {
        $milestones = AboutMilestone::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.about-milestones.index', compact('milestones'));
    }

    public function create(): View
    {
        return view('admin.about-milestones.create');
    }

    public function store(Request $request): RedirectResponse
    {
        AboutMilestone::create($this->validated($request));

        return redirect()->route('admin.about-milestones.index')->with('success', 'Milestone created.');
    }

    public function edit(AboutMilestone $about_milestone): View
    {
        return view('admin.about-milestones.edit', ['milestone' => $about_milestone]);
    }

    public function update(Request $request, AboutMilestone $about_milestone): RedirectResponse
    {
        $about_milestone->update($this->validated($request));

        return redirect()->route('admin.about-milestones.index')->with('success', 'Milestone updated.');
    }

    public function destroy(AboutMilestone $about_milestone): RedirectResponse
    {
        $about_milestone->delete();

        return back()->with('success', 'Milestone deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'year' => 'required|string|max:10',
            'headline' => 'required|string|max:255',
            'headline_description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
