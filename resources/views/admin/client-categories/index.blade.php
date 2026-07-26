@extends('layouts.admin')
@section('title', 'Kategori Client')
@section('page-title', 'Kategori Client')
@section('breadcrumb', 'Social Proof / Client / Kategori')

@section('topbar-actions')
    <a href="{{ route('admin.clients.index') }}" class="cms-btn">Kembali</a>
    <a href="{{ route('admin.client-categories.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Slug</th>
                <th>Jumlah Client</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td><code style="font-size:12px;color:#6b7280">{{ $category->slug }}</code></td>
                    <td>{{ $category->clients_count }}</td>
                    <td>{{ $category->order }}</td>
                    <td><span class="cms-badge {{ $category->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $category->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.client-categories.edit', $category) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.client-categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $categories->links() }}</div>
</div>
@endsection
