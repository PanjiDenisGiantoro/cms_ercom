@extends('layouts.admin')
@section('title', 'Stats')
@section('page-title', 'Stats')
@section('breadcrumb', 'Content / Stats')

@section('topbar-actions')
    <a href="{{ route('admin.stats.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Number</th>
                <th>Label</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($stats as $stat)
                <tr>
                    <td><strong>{{ $stat->stat_number }}</strong></td>
                    <td>{{ $stat->stat_label }}</td>
                    <td>{{ $stat->order }}</td>
                    <td><span class="cms-badge {{ $stat->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $stat->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.stats.edit', $stat) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.stats.destroy', $stat) }}" onsubmit="return confirm('Hapus stat ini?')">
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
    <div style="margin-top:16px">{{ $stats->links() }}</div>
</div>
@endsection
