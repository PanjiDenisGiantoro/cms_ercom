@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('breadcrumb', 'Content / Contact Messages / Detail')

@section('topbar-actions')
    <a href="{{ route('admin.contact-messages.index') }}" class="cms-btn">Kembali</a>
@endsection

@section('content')
<div class="cms-card">
    <div class="cms-card-title">Pesan dari {{ $message->name }}</div>
    <div class="cms-form-row">
        <div class="cms-field">
            <label class="cms-label">Nama</label>
            <div>{{ $message->name }}</div>
        </div>
        <div class="cms-field">
            <label class="cms-label">Nama Business</label>
            <div>{{ $message->business_name ?? '—' }}</div>
        </div>
    </div>
    <div class="cms-form-row" style="margin-top:14px">
        <div class="cms-field">
            <label class="cms-label">Contact Number</label>
            <div>{{ $message->contact_number ?? '—' }}</div>
        </div>
        <div class="cms-field">
            <label class="cms-label">Email</label>
            <div>{{ $message->email ?? '—' }}</div>
        </div>
    </div>
    <div class="cms-field" style="margin-top:14px">
        <label class="cms-label">Deskripsi Pesan</label>
        <div style="white-space:pre-wrap">{{ $message->message ?? '—' }}</div>
    </div>
    <div class="cms-field" style="margin-top:14px">
        <label class="cms-label">Diterima</label>
        <div>{{ $message->created_at->format('d M Y H:i') }}</div>
    </div>
</div>
@endsection
