@extends('layouts.admin')
@section('title', 'Portfolio')
@section('page-title', 'Portfolio')
@section('breadcrumb', 'Content / Portfolio')

@section('topbar-actions')
    <a href="{{ route('admin.portfolio.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Klien</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($portfolios as $portfolio)
                <tr>
                    <td>
                        @if($portfolio->cover_image)
                            <img src="{{ Storage::url($portfolio->cover_image) }}" style="width:52px;height:36px;object-fit:cover;border-radius:6px;" alt="">
                        @else
                            <div style="width:52px;height:36px;background:#f1f5f9;border-radius:6px;"></div>
                        @endif
                    </td>
                    <td><strong>{{ $portfolio->project_title }}</strong></td>
                    <td>{{ $portfolio->category?->name ?? '—' }}</td>
                    <td>{{ $portfolio->client_name ?? '—' }}</td>
                    <td>
                        <span class="cms-badge {{ $portfolio->is_published ? 'cms-badge-green' : 'cms-badge-gray' }}">
                            {{ $portfolio->is_published ? 'Published' : 'Draft' }}
                        </span>
                        @if($portfolio->is_featured)
                            <span class="cms-badge cms-badge-yellow">Featured</span>
                        @endif
                    </td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.portfolio.destroy', $portfolio) }}" onsubmit="return confirm('Hapus portfolio ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada portfolio.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $portfolios->links() }}</div>
</div>
@endsection
