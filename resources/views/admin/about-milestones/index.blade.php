@extends('layouts.admin')
@section('title', 'About - Timeline')
@section('page-title', 'About - Timeline')
@section('breadcrumb', 'Settings / About / Timeline')

@section('topbar-actions')
    <a href="{{ route('admin.about-section3.edit') }}" class="cms-btn">Pengaturan Section</a>
    <a href="{{ route('admin.about-milestones.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Headline</th>
                <th>Deskripsi Headline</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($milestones as $milestone)
                <tr>
                    <td><strong>{{ $milestone->year }}</strong></td>
                    <td>{{ $milestone->headline }}</td>
                    <td>{{ Str::limit(strip_tags($milestone->headline_description), 60) }}</td>
                    <td>{{ $milestone->order }}</td>
                    <td><span class="cms-badge {{ $milestone->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $milestone->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.about-milestones.edit', $milestone) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.about-milestones.destroy', $milestone) }}" onsubmit="return confirm('Hapus milestone ini?')">
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
    <div style="margin-top:16px">{{ $milestones->links() }}</div>
</div>
@endsection
