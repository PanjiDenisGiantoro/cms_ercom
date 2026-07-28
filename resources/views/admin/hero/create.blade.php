@extends('layouts.admin')
@section('title', 'Tambah Hero')
@section('page-title', 'Tambah Hero')
@section('breadcrumb', 'Content / Hero / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.hero.index') }}" class="cms-btn">Kembali</a>
    <button form="hero-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="hero-form" method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="cms-card">
        <div class="cms-card-title">Type</div>
        <div class="cms-field">
            <label class="cms-label">Halaman / Section <span class="cms-required">*</span></label>
            <select name="type" class="cms-input @error('type') is-error @enderror">
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
            @error('type')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">Teks Hero</div>
        <div class="cms-field">
            <label class="cms-label">Headline</label>
            <textarea name="headline" class="cms-input ckeditor-minimal">{{ old('headline') }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Highlighted Word</label>
            <textarea name="highlighted_word" class="cms-input ckeditor-minimal">{{ old('highlighted_word') }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Subheadline</label>
            <textarea name="subheadline" rows="3" class="cms-input ckeditor">{{ old('subheadline') }}</textarea>
        </div>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">CTA & Background</div>
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">CTA Text</label>
                <input type="text" name="cta_text" value="{{ old('cta_text') }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">CTA URL</label>
                <input type="url" name="cta_url" value="{{ old('cta_url') }}" class="cms-input" placeholder="https://...">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Background Image</label>
            <input type="file" name="background_image" class="cms-input" accept="image/*" data-filepond>
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
