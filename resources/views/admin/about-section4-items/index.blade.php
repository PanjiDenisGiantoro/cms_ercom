@extends('layouts.admin')
@section('title', 'About - Section 4')
@section('page-title', 'About - Section 4')
@section('breadcrumb', 'Settings / About / Section 4')

@section('topbar-actions')
    <a href="{{ route('admin.about-section4-pages.index') }}" class="cms-btn">Page</a>
    <a href="{{ route('admin.about-section4-items.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Deskripsi</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td><strong>{{ $item->year }}</strong></td>
                    <td>{{ Str::limit(strip_tags($item->description), 60) }}</td>
                    <td>{{ $item->order }}</td>
                    <td><span class="cms-badge {{ $item->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $item->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.about-section4-items.edit', $item) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.about-section4-items.destroy', $item) }}" onsubmit="return confirm('Hapus item ini?')">
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
    <div style="margin-top:16px">{{ $items->links() }}</div>
</div>
@endsection
