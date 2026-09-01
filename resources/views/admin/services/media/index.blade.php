@extends('layouts.admin')
@section('title', 'Service Media')
@section('page-title', 'Media - ' . $parent->name)
@section('breadcrumb', 'Services / Media')

@section('topbar-actions')
    @php
        $backRoute = route('admin.services.index');
        if ($type === 'item') $backRoute = route('admin.services.items.index', $parent->service_category_id);
        if ($type === 'subitem') $backRoute = route('admin.services.items.sub-items.index', [$parent->item->service_category_id, $parent->service_item_id]);
    @endphp
    <a href="{{ $backRoute }}" class="cms-btn">Kembali ke Induk</a>
    <a href="{{ route('admin.service-media.create', ['type' => $type, 'id' => $id]) }}" class="cms-btn cms-btn-primary">+ Tambah Media</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Preview</th><th>Tipe Media</th><th>Order</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($mediaList as $media)
                <tr>
                    <td>
                        @if($media->media_type === 'photo')
                            <img src="{{ $media->file_url }}" style="width:80px;height:50px;object-fit:cover;border-radius:4px;" alt="">
                        @else
                            <div style="position:relative;width:80px;height:50px;border-radius:4px;overflow:hidden;background:#000;">
                                <img src="{{ $media->thumbnail_url }}" style="width:100%;height:100%;object-fit:cover;opacity:0.6;" alt="">
                                <svg style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:20px;height:20px;color:white;" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        @endif
                    </td>
                    <td><span class="cms-badge cms-badge-blue">{{ strtoupper($media->media_type) }}</span></td>
                    <td>{{ $media->order }}</td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.service-media.edit', $media) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.service-media.destroy', $media) }}" onsubmit="return confirm('Hapus media?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="cms-empty">Belum ada media.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $mediaList->links() }}</div>
</div>
@endsection
