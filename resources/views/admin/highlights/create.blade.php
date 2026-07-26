@extends('layouts.admin')
@section('title', 'Tambah Highlight')
@section('page-title', 'Tambah Highlight')
@section('breadcrumb', 'Content / Highlight / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.highlights.index') }}" class="cms-btn">Kembali</a>
    <button form="highlight-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="highlight-form" method="POST" action="{{ route('admin.highlights.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Title <span class="cms-required">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="cms-input @error('title') is-error @enderror">
            @error('title')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Description</label>
            <textarea name="description" rows="3" class="cms-input">{{ old('description') }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Icon Image</label>
                <input type="file" name="icon_image" class="cms-input" accept="image/*">
                @error('icon_image')<span class="cms-error">{{ $message }}</span>@enderror
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
