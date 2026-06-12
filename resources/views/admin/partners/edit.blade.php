@extends('layouts.admin')
@section('title', 'Edit Partner')
@section('page-title', 'Edit Partner')
@section('breadcrumb', 'Social Proof / Partners / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.partners.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Partner <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $partner->name) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Website URL</label>
                <input type="url" name="website_url" value="{{ old('website_url', $partner->website_url) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Logo</label>
                <img src="{{ Storage::url($partner->logo_image) }}" class="cms-img-preview" alt="Logo">
                <input type="file" name="logo_image" class="cms-input" accept="image/*">
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $partner->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $partner->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
