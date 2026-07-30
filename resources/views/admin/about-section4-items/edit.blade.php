@extends('layouts.admin')
@section('title', 'Edit Item')
@section('page-title', 'Edit Item')
@section('breadcrumb', 'Settings / About / Section 4 / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.about-section4-items.index') }}" class="cms-btn">Kembali</a>
    <button form="section4-item-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="section4-item-form" method="POST" action="{{ route('admin.about-section4-items.update', $item) }}">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Tahun <span class="cms-required">*</span></label>
                <input type="text" name="year" value="{{ old('year', $item->year) }}" class="cms-input @error('year') is-error @enderror" placeholder="2018">
                @error('year')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $item->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input ckeditor">{{ old('description', $item->description) }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
