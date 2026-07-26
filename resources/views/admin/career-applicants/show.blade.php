@extends('layouts.admin')
@section('title', 'Detail Pelamar')
@section('page-title', 'Detail Pelamar')
@section('breadcrumb', 'Content / Career / Pelamar / Detail')

@section('topbar-actions')
    <a href="{{ route('admin.career-applicants.index') }}" class="cms-btn">Kembali</a>
    <a href="{{ route('admin.career-applicants.download', $applicant) }}" class="cms-btn cms-btn-primary">Download CV</a>
@endsection

@section('content')
<div class="cms-card">
    <div class="cms-card-title">Lamaran dari {{ $applicant->name ?? $applicant->email }}</div>
    <div class="cms-form-row">
        <div class="cms-field">
            <label class="cms-label">Nama</label>
            <div>{{ $applicant->name ?? '—' }}</div>
        </div>
        <div class="cms-field">
            <label class="cms-label">Posisi</label>
            <div>{{ $applicant->career?->title ?? '—' }}</div>
        </div>
    </div>
    <div class="cms-form-row" style="margin-top:14px">
        <div class="cms-field">
            <label class="cms-label">Email</label>
            <div>{{ $applicant->email }}</div>
        </div>
        <div class="cms-field">
            <label class="cms-label">Phone</label>
            <div>{{ $applicant->phone ?? '—' }}</div>
        </div>
    </div>
    <div class="cms-field" style="margin-top:14px">
        <label class="cms-label">Address</label>
        <div>{{ $applicant->address ?? '—' }}</div>
    </div>
    <div class="cms-field" style="margin-top:14px">
        <label class="cms-label">Tanggal Melamar</label>
        <div>{{ $applicant->created_at->format('d M Y H:i') }}</div>
    </div>
</div>
@endsection
