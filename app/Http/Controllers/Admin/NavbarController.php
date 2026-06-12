<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavbarSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavbarController extends Controller
{
    public function edit(): View
    {
        $navbar = NavbarSetting::instance();

        return view('admin.navbar.edit', compact('navbar'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'logo_light' => 'nullable|image|max:2048',
            'logo_dark' => 'nullable|image|max:2048',
            'menu_items' => 'nullable|array',
            'menu_items.*.label' => 'required|string|max:100',
            'menu_items.*.url' => 'required|string|max:255',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:20',
            'sticky_on_scroll' => 'boolean',
        ]);

        if ($request->hasFile('logo_light')) {
            $data['logo_light'] = $request->file('logo_light')->store('navbar', 'public');
        }

        if ($request->hasFile('logo_dark')) {
            $data['logo_dark'] = $request->file('logo_dark')->store('navbar', 'public');
        }

        NavbarSetting::instance()->update($data);

        return back()->with('success', 'Navbar updated.');
    }
}
