@extends('layouts.admin')
@section('title', 'Hero')
@section('page-title', 'Hero')
@section('breadcrumb', 'Content / Hero')

@section('topbar-actions')
    <a href="{{ route('admin.hero.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <form method="GET" action="{{ route('admin.hero.index') }}" class="cms-field" style="max-width:260px;margin-bottom:16px">
        <label class="cms-label">Filter Type</label>
        <select name="type" class="cms-input" onchange="this.form.submit()">
            <option value="">Semua Type</option>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
    </form>

    <table class="cms-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Headline</th>
                <th>Subheadline</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($heroes as $hero)
                <tr>
                    <td><span class="cms-badge cms-badge-blue">{{ ucfirst($hero->type) }}</span></td>
                    <td>{{ Str::limit(strip_tags($hero->headline), 60) }}</td>
                    <td>{{ Str::limit(strip_tags($hero->subheadline), 60) }}</td>
                    <td><span class="cms-badge {{ $hero->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $hero->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td>{{ $hero->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $hero->updated_at->format('d M Y H:i') }}</td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.hero.edit', $hero) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.hero.destroy', $hero) }}" onsubmit="return confirm('Hapus hero ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="cms-empty">Belum ada data hero.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $heroes->links() }}</div>
</div>
@endsection
