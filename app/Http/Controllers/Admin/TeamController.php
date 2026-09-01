<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $members = Team::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.team.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.team.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['photo'] = $this->resolveUpload($request, 'photo', 'team');
        $data['background_image'] = $this->resolveUpload($request, 'background_image', 'team');

        Team::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member created.');
    }

    public function edit(Team $team): View
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, Team $team): RedirectResponse
    {
        $data = $this->validated($request);
        $this->applyUpload($data, $request, 'photo', 'team');
        $this->applyUpload($data, $request, 'background_image', 'team');

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(Team $team): RedirectResponse
    {
        $team->delete();

        return back()->with('success', 'Team member deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable',
            'background_image' => 'nullable',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
