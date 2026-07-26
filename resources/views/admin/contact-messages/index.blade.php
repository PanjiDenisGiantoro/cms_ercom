@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')
@section('breadcrumb', 'Content / Contact Messages')

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Business</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Diterima</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $message)
                <tr>
                    <td><strong>{{ $message->name }}</strong></td>
                    <td>{{ $message->business_name ?? '—' }}</td>
                    <td>{{ $message->contact_number ?? '—' }}</td>
                    <td>{{ $message->email ?? '—' }}</td>
                    <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.contact-messages.show', $message) }}" class="cms-btn cms-btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="cms-empty">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $messages->links() }}</div>
</div>
@endsection
