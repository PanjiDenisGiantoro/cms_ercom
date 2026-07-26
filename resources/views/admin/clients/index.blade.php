@extends('layouts.admin')
@section('title', 'Client')
@section('page-title', 'Client')
@section('breadcrumb', 'Social Proof / Client')

@section('topbar-actions')
    <a href="{{ route('admin.client-categories.index') }}" class="cms-btn">Kategori</a>
    <a href="{{ route('admin.clients.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Logo</th><th>Nama</th><th>Kategori</th><th>Website</th><th>Order</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td><img src="{{ Storage::url($client->logo_image) }}" style="height:32px;max-width:80px;object-fit:contain;" alt="{{ $client->name }}"></td>
                    <td><strong>{{ $client->name }}</strong></td>
                    <td>{{ $client->category?->name ?? '—' }}</td>
                    <td>
                        @if($client->website_url)
                            <a href="{{ $client->website_url }}" target="_blank" style="color:#4a9da8">{{ parse_url($client->website_url, PHP_URL_HOST) }}</a>
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $client->order }}</td>
                    <td><span class="cms-badge {{ $client->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $client->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.clients.edit', $client) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" onsubmit="return confirm('Hapus client ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="cms-empty">Belum ada client.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $clients->links() }}</div>
</div>
@endsection
