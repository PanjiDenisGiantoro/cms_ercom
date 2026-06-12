@extends('layouts.admin')
@section('title', 'Sub-Items')
@section('page-title', 'Sub-Items — ' . $item->name)
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / ' . $item->name . ' / Sub-Items')

@section('topbar-actions')
    <a href="{{ route('admin.services.items.index', $service) }}" class="cms-btn">Kembali</a>
    <a href="{{ route('admin.services.items.sub-items.create', [$service, $item]) }}" class="cms-btn cms-btn-primary">+ Tambah Sub-item</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Thumbnail</th><th>Nama</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($subItems as $subItem)
                <tr>
                    <td>
                        @if($subItem->thumbnail)
                            <img src="{{ Storage::url($subItem->thumbnail) }}" style="width:48px;height:32px;object-fit:cover;border-radius:4px;" alt="">
                        @else
                            <div style="width:48px;height:32px;background:#f1f5f9;border-radius:4px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $subItem->name }}</strong></td>
                    <td>{{ $subItem->order }}</td>
                    <td><span class="cms-badge {{ $subItem->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $subItem->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.services.items.sub-items.edit', [$service, $item, $subItem]) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.services.items.sub-items.destroy', [$service, $item, $subItem]) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="cms-empty">Belum ada sub-item.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $subItems->links() }}</div>
</div>
@endsection
