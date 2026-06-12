@extends('layouts.admin')
@section('title', 'Tambah Partner')
@section('page-title', 'Tambah Partner')
@section('breadcrumb', 'Social Proof / Partners / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.partners.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Partner <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Website URL</label>
                <input type="url" name="website_url" value="{{ old('website_url') }}" class="cms-input" placeholder="https://...">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Logo <span class="cms-required">*</span></label>
                <input type="file" name="logo_image" class="cms-input" accept="image/*" required>
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
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
