@extends('layouts.admin')
@section('title', 'Career')
@section('page-title', 'Career')
@section('breadcrumb', 'Content / Career')

@section('topbar-actions')
    <a href="{{ route('admin.careers.create') }}" class="cms-btn cms-btn-primary">+ Tambah Lowongan</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Posisi</th>
                <th>Tipe</th>
                <th>Lokasi</th>
                <th>Order</th>
                <th>Status</th>
                <th>Pelamar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($careers as $career)
                <tr>
                    <td><strong>{{ $career->title }}</strong></td>
                    <td>{{ $career->employment_type ?? '—' }}</td>
                    <td>{{ $career->location ?? '—' }}</td>
                    <td>{{ $career->order }}</td>
                    <td><span class="cms-badge {{ $career->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $career->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td>{{ $career->applications_count }}</td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.careers.applications.index', $career) }}" class="cms-btn cms-btn-sm cms-badge-blue" style="background:#eff6ff;color:#1d4ed8;border-color:#bfdbfe">Pelamar</a>
                        <a href="{{ route('admin.careers.edit', $career) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" onsubmit="return confirm('Hapus lowongan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="cms-empty">Belum ada lowongan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $careers->links() }}</div>
</div>
@endsection
