@extends('layouts.admin')
@section('title', 'Hero')
@section('page-title', 'Hero')
@section('breadcrumb', 'Settings / Hero')

@section('topbar-actions')
    <button form="hero-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="hero-form" method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">Teks Hero</div>
        <div class="cms-field">
            <label class="cms-label">Headline</label>
            <textarea name="headline" class="cms-input ckeditor-minimal">{{ old('headline', $hero->headline) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Highlighted Word</label>
            <textarea name="highlighted_word" class="cms-input ckeditor-minimal">{{ old('highlighted_word', $hero->highlighted_word) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Subheadline</label>
            <textarea name="subheadline" rows="3" class="cms-input ckeditor">{{ old('subheadline', $hero->subheadline) }}</textarea>
        </div>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">CTA & Background</div>
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">CTA Text</label>
                <input type="text" name="cta_text" value="{{ old('cta_text', $hero->cta_text) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">CTA URL</label>
                <input type="url" name="cta_url" value="{{ old('cta_url', $hero->cta_url) }}" class="cms-input" placeholder="https://...">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Background Image</label>
            @if($hero->background_image)
                <img src="{{ Storage::url($hero->background_image) }}" class="cms-img-preview" alt="Background">
            @endif
            <input type="file" name="background_image" class="cms-input" accept="image/*">
        </div>
    </div>

</form>
@endsection
