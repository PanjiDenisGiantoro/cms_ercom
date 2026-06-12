@extends('layouts.admin')
@section('title', 'Service Categories')
@section('page-title', 'Service Categories')
@section('breadcrumb', 'Content / Services')

@section('topbar-actions')
    <a href="{{ route('admin.service-settings.edit') }}" class="cms-btn">Header Section</a>
    <a href="{{ route('admin.services.create') }}" class="cms-btn cms-btn-primary">+ Tambah Kategori</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Cover</th><th>Nama</th><th>Slug</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>
                        @if($category->cover_image)
                            <img src="{{ Storage::url($category->cover_image) }}" style="width:48px;height:32px;object-fit:cover;border-radius:4px;" alt="">
                        @else
                            <div style="width:48px;height:32px;background:#f1f5f9;border-radius:4px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td><code style="font-size:12px;color:#6b7280">{{ $category->slug }}</code></td>
                    <td>{{ $category->order }}</td>
                    <td><span class="cms-badge {{ $category->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $category->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.services.items.index', $category) }}" class="cms-btn cms-btn-sm cms-badge-blue" style="background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe">Items</a>
                        <a href="{{ route('admin.services.edit', $category) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada kategori layanan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $categories->links() }}</div>
</div>
@endsection
