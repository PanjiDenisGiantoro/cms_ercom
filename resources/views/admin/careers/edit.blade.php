@extends('layouts.admin')
@section('title', 'Edit Lowongan')
@section('page-title', 'Edit Lowongan')
@section('breadcrumb', 'Content / Career / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.careers.index') }}" class="cms-btn">Kembali</a>
    <button form="career-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="career-form" method="POST" action="{{ route('admin.careers.update', $career) }}">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Posisi <span class="cms-required">*</span></label>
                <input type="text" name="title" value="{{ old('title', $career->title) }}" class="cms-input @error('title') is-error @enderror">
                @error('title')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Tipe Pekerjaan</label>
                <input type="text" name="employment_type" value="{{ old('employment_type', $career->employment_type) }}" class="cms-input" placeholder="Full-time, Part-time, Internship">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $career->location) }}" class="cms-input" placeholder="Jakarta Selatan">
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $career->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Spesifikasi</label>
            <textarea name="description" rows="6" class="cms-input ckeditor">{{ old('description', $career->description) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $career->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection