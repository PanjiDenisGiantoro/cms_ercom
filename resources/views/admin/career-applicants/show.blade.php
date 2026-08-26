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

@if($applicant->cv)
<div class="cms-card" style="margin-top:16px">
    <div class="cms-card-title">Preview CV</div>
    @php
        $cvUrl = Storage::disk('public')->url($applicant->cv);
        $ext = strtolower(pathinfo($applicant->cv, PATHINFO_EXTENSION));
    @endphp
    @if($ext === 'pdf')
        <iframe src="{{ $cvUrl }}" style="width:100%;height:600px;border:1px solid #e2e8f0;border-radius:8px;" frameborder="0"></iframe>
    @elseif(in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
        <img src="{{ $cvUrl }}" style="max-width:100%;border-radius:8px;" alt="CV Preview">
    @else
        <div style="padding:16px;background:#f8fafc;border-radius:8px;text-align:center;color:#64748b">
            <p>Preview tidak tersedia untuk file <strong>.{{ $ext }}</strong></p>
            <a href="{{ route('admin.career-applicants.download', $applicant) }}" class="cms-btn cms-btn-primary" style="margin-top:8px">Download CV</a>
        </div>
    @endif
</div>
@endif
@endsection
