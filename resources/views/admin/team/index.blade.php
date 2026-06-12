@extends('layouts.admin')
@section('title', 'Team')
@section('page-title', 'Team')
@section('breadcrumb', 'Social Proof / Team')

@section('topbar-actions')
    <a href="{{ route('admin.team.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Foto</th><th>Nama</th><th>Posisi</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td>
                        @if($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;" alt="">
                        @else
                            <div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#8896a8">{{ strtoupper(substr($member->name,0,1)) }}</div>
                        @endif
                    </td>
                    <td><strong>{{ $member->name }}</strong></td>
                    <td>{{ $member->position }}</td>
                    <td>{{ $member->order }}</td>
                    <td><span class="cms-badge {{ $member->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $member->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.team.edit', $member) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada anggota tim.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $members->links() }}</div>
</div>
@endsection
