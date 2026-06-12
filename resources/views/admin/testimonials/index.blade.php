@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('breadcrumb', 'Social Proof / Testimonials')

@section('topbar-actions')
    <a href="{{ route('admin.testimonials.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Foto</th><th>Nama</th><th>Peran</th><th>Rating</th><th>Order</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $t)
                <tr>
                    <td>
                        @if($t->photo)
                            <img src="{{ Storage::url($t->photo) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;" alt="">
                        @else
                            <div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#8896a8">{{ strtoupper(substr($t->name,0,1)) }}</div>
                        @endif
                    </td>
                    <td><strong>{{ $t->name }}</strong></td>
                    <td>{{ $t->company_role ?? '—' }}</td>
                    <td>{{ str_repeat('★', $t->rating) }}</td>
                    <td>{{ $t->order }}</td>
                    <td><span class="cms-badge {{ $t->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $t->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="cms-empty">Belum ada testimonial.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $testimonials->links() }}</div>
</div>
@endsection
