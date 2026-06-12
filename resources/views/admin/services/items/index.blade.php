@extends('layouts.admin')
@section('title', 'Service Items')
@section('page-title', 'Service Items — ' . $service->name)
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / Items')

@section('topbar-actions')
    <a href="{{ route('admin.services.index') }}" class="cms-btn">Kembali</a>
    <a href="{{ route('admin.services.items.create', $service) }}" class="cms-btn cms-btn-primary">+ Tambah Item</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Thumbnail</th><th>Nama</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>
                        @if($item->thumbnail)
                            <img src="{{ Storage::url($item->thumbnail) }}" style="width:48px;height:32px;object-fit:cover;border-radius:4px;" alt="">
                        @else
                            <div style="width:48px;height:32px;background:#f1f5f9;border-radius:4px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->order }}</td>
                    <td><span class="cms-badge {{ $item->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $item->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.services.items.sub-items.index', [$service, $item]) }}" class="cms-btn cms-btn-sm" style="background:#f5f3ff;color:#7c3aed;border-color:#ddd6fe">Sub-items</a>
                        <a href="{{ route('admin.services.items.edit', [$service, $item]) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.services.items.destroy', [$service, $item]) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="cms-empty">Belum ada item layanan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $items->links() }}</div>
</div>
@endsection
