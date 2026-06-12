@extends('layouts.admin')
@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Social Proof / Partners')

@section('topbar-actions')
    <a href="{{ route('admin.partners.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Logo</th><th>Nama</th><th>Website</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($partners as $partner)
                <tr>
                    <td><img src="{{ Storage::url($partner->logo_image) }}" style="height:32px;max-width:80px;object-fit:contain;" alt="{{ $partner->name }}"></td>
                    <td><strong>{{ $partner->name }}</strong></td>
                    <td>{{ $partner->website_url ? '<a href="'.$partner->website_url.'" target="_blank" style="color:#4a9da8">'.parse_url($partner->website_url, PHP_URL_HOST).'</a>' : '—' }}</td>
                    <td>{{ $partner->order }}</td>
                    <td><span class="cms-badge {{ $partner->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $partner->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada partner.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $partners->links() }}</div>
</div>
@endsection
