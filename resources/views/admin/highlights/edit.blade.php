@extends('layouts.admin')
@section('title', 'Edit Highlight')
@section('page-title', 'Edit Highlight')
@section('breadcrumb', 'Content / Highlight / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.highlights.index') }}" class="cms-btn">Kembali</a>
    <button form="highlight-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="highlight-form" method="POST" action="{{ route('admin.highlights.update', $highlight) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Title <span class="cms-required">*</span></label>
            <input type="text" name="title" value="{{ old('title', $highlight->title) }}" class="cms-input @error('title') is-error @enderror">
            @error('title')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Description</label>
            <textarea name="description" rows="3" class="cms-input">{{ old('description', $highlight->description) }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Icon Image</label>
                @if($highlight->icon_image)
                    <img src="{{ Storage::url($highlight->icon_image) }}" class="cms-img-preview" alt="Icon">
                @endif
                <input type="file" name="icon_image" class="cms-input" accept="image/*">
                @error('icon_image')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $highlight->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $highlight->is_active) ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
