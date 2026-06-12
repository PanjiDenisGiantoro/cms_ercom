<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::with('category')->latest()->paginate(15);

        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create(): View
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('order')->get();

        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'project_title' => 'required|string|max:255',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'cover_image' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url',
            'project_date' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['project_title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        Portfolio::create($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio created.');
    }

    public function edit(Portfolio $portfolio): View
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('order')->get();

        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $request->validate([
            'project_title' => 'required|string|max:255',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'cover_image' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url',
            'project_date' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('portfolio', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio updated.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        return back()->with('success', 'Portfolio deleted.');
    }
}
