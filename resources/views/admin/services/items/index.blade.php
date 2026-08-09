@extends('layouts.admin')
@section('title', 'Service Items')
@section('page-title', 'Service Items — ' . $service->name)
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / Items')

@section('topbar-actions')
    <a href="{{ route('admin.services.index') }}" class="cms-btn">Kembali</a>
    <a href="{{ route('admin.services.items.create', $service) }}" class="cms-btn cms-btn-primary">+ Tambah Item</a>
@endsection

@section('content')
@php
    $selectedCount = $service->items()->where('is_selected', true)->count();
@endphp
<div class="cms-card">
    <div style="margin-bottom:14px;font-size:13px;color:#64748b">
        Item terpilih untuk frontend: <strong>{{ $selectedCount }}/4</strong>
    </div>
    <table class="cms-table">
        <thead>
            <tr><th>Thumbnail</th><th>Nama</th><th>Order</th><th>Status</th><th>Terpilih</th><th>Dibuat</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>
                        @if($item->thumbnail)
                            <img src="{{ str_starts_with($item->thumbnail, 'http') ? $item->thumbnail : Storage::url($item->thumbnail) }}" style="width:48px;height:32px;object-fit:cover;border-radius:4px;" alt="">
                        @else
                            <div style="width:48px;height:32px;background:#f1f5f9;border-radius:4px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->order }}</td>
                    <td><span class="cms-badge {{ $item->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $item->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.services.items.toggle-selected', [$service, $item]) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="cms-btn cms-btn-sm{{ $item->is_selected ? ' cms-btn-primary' : '' }}"
                                title="{{ $item->is_selected ? 'Batalkan pilihan' : 'Pilih untuk frontend (maks. 4)' }}">
                                {{ $item->is_selected ? '★ Terpilih' : '☆ Pilih' }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
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
                <tr><td colspan="7" class="cms-empty">Belum ada item layanan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $items->links() }}</div>
</div>
@endsection
