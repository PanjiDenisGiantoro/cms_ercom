@extends('layouts.admin')
@section('title', 'Highlight')
@section('page-title', 'Highlight')
@section('breadcrumb', 'Content / Highlight')

@section('topbar-actions')
    <a href="{{ route('admin.highlights.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($highlights as $highlight)
                <tr>
                    <td>
                        @if($highlight->icon_image)
                            <img src="{{ Storage::url($highlight->icon_image) }}" style="width:36px;height:36px;object-fit:cover;border-radius:4px;" alt="">
                        @else
                            <div style="width:36px;height:36px;background:#f1f5f9;border-radius:4px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $highlight->title }}</strong></td>
                    <td>{{ $highlight->order }}</td>
                    <td><span class="cms-badge {{ $highlight->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $highlight->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.highlights.edit', $highlight) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.highlights.destroy', $highlight) }}" onsubmit="return confirm('Hapus highlight ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="cms-empty">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $highlights->links() }}</div>
</div>
@endsection
