@extends('layouts.admin')
@section('title', 'About - What Drives ER')
@section('page-title', 'About - What Drives ER')
@section('breadcrumb', 'Settings / About / What Drives ER')

@section('topbar-actions')
    <a href="{{ route('admin.about-sections.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title</th>
                <th>Deskripsi</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($sections as $section)
                <tr>
                    <td>
                        <div style="width:36px;height:36px;background:#f1f5f9;border-radius:4px;display:flex;align-items:center;justify-content:center;">
                            @if($section->icon)
                                <i class="{{ $section->icon }}" style="font-size:16px;color:#2d3f55"></i>
                            @endif
                        </div>
                    </td>
                    <td><strong>{{ $section->title }}</strong></td>
                    <td>{{ Str::limit(strip_tags($section->description), 60) }}</td>
                    <td>{{ $section->order }}</td>
                    <td><span class="cms-badge {{ $section->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $section->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.about-sections.edit', $section) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.about-sections.destroy', $section) }}" onsubmit="return confirm('Hapus section ini?')">
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
    <div style="margin-top:16px">{{ $sections->links() }}</div>
</div>
@endsection
