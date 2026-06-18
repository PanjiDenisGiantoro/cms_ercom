@extends('layouts.admin')
@section('title', 'Tambah Testimonial')
@section('page-title', 'Tambah Testimonial')
@section('breadcrumb', 'Social Proof / Testimonials / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.testimonials.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Peran / Perusahaan</label>
                <input type="text" name="company_role" value="{{ old('company_role') }}" class="cms-input" placeholder="CEO at Company">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Teks Testimonial <span class="cms-required">*</span></label>
            <textarea name="testimonial_text" rows="4" class="cms-input ckeditor">{{ old('testimonial_text') }}</textarea>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Foto</label>
                <input type="file" name="photo" class="cms-input" accept="image/*">
            </div>
            <div class="cms-field">
                <label class="cms-label">Rating (1–5)</label>
                <input type="number" name="rating" value="{{ old('rating', 5) }}" class="cms-input" min="1" max="5">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
            <div class="cms-field" style="justify-content:flex-end;padding-bottom:2px">
                <label class="cms-toggle-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <span>Aktif</span>
                </label>
            </div>
        </div>
    </div>
</form>
@endsection
