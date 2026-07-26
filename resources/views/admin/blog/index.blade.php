@extends('layouts.admin')
@section('title', 'Blog')
@section('page-title', 'Blog')
@section('breadcrumb', 'Content / Blog')

@section('topbar-actions')
    <a href="{{ route('admin.blog-categories.index') }}" class="cms-btn">Kategori</a>
    <a href="{{ route('admin.blog.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td>
                        @if($blog->cover_image)
                            <img src="{{ Storage::url($blog->cover_image) }}" style="width:52px;height:36px;object-fit:cover;border-radius:6px;" alt="">
                        @else
                            <div style="width:52px;height:36px;background:#f1f5f9;border-radius:6px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $blog->title }}</strong></td>
                    <td>{{ $blog->category?->name ?? '—' }}</td>
                    <td>{{ $blog->author ?? '—' }}</td>
                    <td>
                        <span class="cms-badge {{ $blog->is_published ? 'cms-badge-green' : 'cms-badge-gray' }}">
                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.blog.edit', $blog) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.blog.destroy', $blog) }}" onsubmit="return confirm('Hapus blog ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada blog.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $blogs->links() }}</div>
</div>
@endsection
