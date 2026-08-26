@extends('layouts.admin')
@section('title', 'About - History')
@section('page-title', 'About - History (Page)')
@section('breadcrumb', 'Settings / About / History')

@section('topbar-actions')
    <a href="{{ route('admin.about-section4-items.index') }}" class="cms-btn">Kembali</a>
    <a href="{{ route('admin.about-section4-pages.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Title</th>
                <th>Deskripsi</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $page)
                <tr>
                    <td><strong>{{ $page->year }}</strong></td>
                    <td>{{ $page->title }}</td>
                    <td>{{ Str::limit(strip_tags($page->description), 60) }}</td>
                    <td>{{ $page->order }}</td>
                    <td><span class="cms-badge {{ $page->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $page->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.about-section4-pages.edit', $page) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.about-section4-pages.destroy', $page) }}" onsubmit="return confirm('Hapus page ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $pages->links() }}</div>
</div>
@endsection
