@extends('layouts.admin')
@section('title', 'Tambah Lowongan')
@section('page-title', 'Tambah Lowongan')
@section('breadcrumb', 'Content / Career / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.careers.index') }}" class="cms-btn">Kembali</a>
    <button form="career-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="career-form" method="POST" action="{{ route('admin.careers.store') }}">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Posisi <span class="cms-required">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="cms-input @error('title') is-error @enderror" placeholder="Social Media Specialist">
                @error('title')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Tipe Pekerjaan</label>
                <input type="text" name="employment_type" value="{{ old('employment_type') }}" class="cms-input" placeholder="Full-time, Part-time, Internship">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}" class="cms-input" placeholder="Jakarta Selatan">
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Spesifikasi</label>
            <textarea name="description" rows="6" class="cms-input ckeditor">{{ old('description') }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection