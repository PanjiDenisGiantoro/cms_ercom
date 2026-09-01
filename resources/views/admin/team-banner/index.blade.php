@extends('layouts.admin')
@section('title', 'Team Banner')
@section('page-title', 'Team Banner (Siluet)')
@section('breadcrumb', 'Social Proof / Team / Banner')

@section('topbar-actions')
    <a href="{{ route('admin.team-banners.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Foto</th><th>Nama</th><th>Role</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($banners as $banner)
                <tr>
                    <td>
                        @if($banner->image)
                            <img src="{{ Storage::url($banner->image) }}" style="width:64px;height:40px;border-radius:4px;object-fit:cover;" alt="">
                        @else
                            <div style="width:64px;height:40px;border-radius:4px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:12px;color:#8896a8">No Img</div>
                        @endif
                    </td>
                    <td><strong>{{ $banner->name ?? '—' }}</strong></td>
                    <td>{{ $banner->role ?? '—' }}</td>
                    <td>{{ $banner->order }}</td>
                    <td><span class="cms-badge {{ $banner->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $banner->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.team-banners.edit', $banner) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.team-banners.destroy', $banner) }}" onsubmit="return confirm('Hapus banner?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada banner tim.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $banners->links() }}</div>
</div>
@endsection
