@extends('layouts.admin')
@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')
@section('breadcrumb', 'Social Proof / Testimonials / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.testimonials.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Peran / Perusahaan</label>
                <input type="text" name="company_role" value="{{ old('company_role', $testimonial->company_role) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Teks Testimonial <span class="cms-required">*</span></label>
            <textarea name="testimonial_text" rows="4" class="cms-input">{{ old('testimonial_text', $testimonial->testimonial_text) }}</textarea>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Foto</label>
                @if($testimonial->photo)
                    <img src="{{ Storage::url($testimonial->photo) }}" class="cms-img-preview" alt="Foto">
                @endif
                <input type="file" name="photo" class="cms-input" accept="image/*">
            </div>
            <div class="cms-field">
                <label class="cms-label">Rating (1–5)</label>
                <input type="number" name="rating" value="{{ old('rating', $testimonial->rating) }}" class="cms-input" min="1" max="5">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $testimonial->order) }}" class="cms-input" min="0">
            </div>
            <div class="cms-field" style="justify-content:flex-end;padding-bottom:2px">
                <label class="cms-toggle-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}>
                    <span>Aktif</span>
                </label>
            </div>
        </div>
    </div>
</form>
@endsection
