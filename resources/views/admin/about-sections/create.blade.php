@extends('layouts.admin')
@section('title', 'Tambah Section')
@section('page-title', 'Tambah Section')
@section('breadcrumb', 'Settings / About / Section 2 / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.about-sections.index') }}" class="cms-btn">Kembali</a>
    <button form="about-section-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="about-section-form" method="POST" action="{{ route('admin.about-sections.store') }}">
    @csrf
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Title <span class="cms-required">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="cms-input @error('title') is-error @enderror">
            @error('title')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="3" class="cms-input ckeditor">{{ old('description') }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Icon</label>
                <div style="display:flex;align-items:center;gap:12px">
                    <i id="icon-preview" class="{{ old('icon') }}" style="font-size:22px;width:28px;text-align:center;color:#2d3f55"></i>
                    <select name="icon" class="cms-input" onchange="document.getElementById('icon-preview').className = this.value">
                        <option value="">— Pilih Icon —</option>
                        @include('admin.about-sections._icon-options', ['selected' => old('icon')])
                    </select>
                </div>
                @error('icon')<span class="cms-error">{{ $message }}</span>@enderror
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
