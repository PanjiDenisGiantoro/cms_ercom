<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ClientCategory::withCount('clients')->orderBy('order')->paginate(15);

        return view('admin.client-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.client-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        ClientCategory::create($this->validated($request));

        return redirect()->route('admin.client-categories.index')->with('success', 'Kategori created.');
    }

    public function edit(ClientCategory $client_category): View
    {
        return view('admin.client-categories.edit', ['category' => $client_category]);
    }

    public function update(Request $request, ClientCategory $client_category): RedirectResponse
    {
        $client_category->update($this->validated($request));

        return redirect()->route('admin.client-categories.index')->with('success', 'Kategori updated.');
    }

    public function destroy(ClientCategory $client_category): RedirectResponse
    {
        $client_category->delete();

        return back()->with('success', 'Kategori deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
    }
}
