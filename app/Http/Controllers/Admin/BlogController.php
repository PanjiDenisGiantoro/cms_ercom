<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::with('category')->orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.blog.index', compact('blogs'));
    }

    public function create(): View
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('order')->get();

        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['cover_image'] = $this->resolveUpload($request, 'cover_image', 'blog');

        Blog::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog created.');
    }

    public function edit(Blog $blog): View
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('order')->get();

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $data = $this->validated($request);
        $this->applyUpload($data, $request, 'cover_image', 'blog');

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog updated.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return back()->with('success', 'Blog deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);
    }
}
