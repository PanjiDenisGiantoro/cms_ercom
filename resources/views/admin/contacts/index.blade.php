@extends('layouts.admin')
@section('title', 'Contact')
@section('page-title', 'Contact')
@section('breadcrumb', 'Content / Contact')

@section('topbar-actions')
    <a href="{{ route('admin.contacts.create') }}" class="cms-btn cms-btn-primary">+ Tambah</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Label</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Order</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td><strong>{{ $contact->label }}</strong></td>
                    <td>{{ Str::limit($contact->address, 40) }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->order }}</td>
                    <td><span class="cms-badge {{ $contact->is_active ? 'cms-badge-green' : 'cms-badge-gray' }}">{{ $contact->is_active ? 'Aktif' : 'Non-aktif' }}</span></td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.contacts.edit', $contact) }}" class="cms-btn cms-btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Hapus contact ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="cms-empty">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $contacts->links() }}</div>
</div>
@endsection
