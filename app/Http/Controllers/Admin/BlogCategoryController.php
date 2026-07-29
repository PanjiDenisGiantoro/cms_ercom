<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::withCount('blogs')->orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        BlogCategory::create($this->validated($request));

        return redirect()->route('admin.blog-categories.index')->with('success', 'Kategori created.');
    }

    public function edit(BlogCategory $blog_category): View
    {
        return view('admin.blog-categories.edit', ['category' => $blog_category]);
    }

    public function update(Request $request, BlogCategory $blog_category): RedirectResponse
    {
        $blog_category->update($this->validated($request));

        return redirect()->route('admin.blog-categories.index')->with('success', 'Kategori updated.');
    }

    public function destroy(BlogCategory $blog_category): RedirectResponse
    {
        $blog_category->delete();

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
