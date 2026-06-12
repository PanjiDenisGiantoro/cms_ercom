@extends('layouts.admin')
@section('title', 'SEO')
@section('page-title', 'SEO Settings')
@section('breadcrumb', 'Settings / SEO')

@section('topbar-actions')
    <button form="seo-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="seo-form" method="POST" action="{{ route('admin.seo.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">Meta Tags</div>
        <div class="cms-field">
            <label class="cms-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $seo->meta_title) }}" class="cms-input" placeholder="Nama Website — Tagline">
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Meta Description</label>
            <textarea name="meta_description" rows="3" class="cms-input">{{ old('meta_description', $seo->meta_description) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Keywords</label>
            <input type="text" name="keywords" value="{{ old('keywords', $seo->keywords) }}" class="cms-input" placeholder="kata kunci, dipisah, koma">
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">OG Image</label>
                @if($seo->og_image)
                    <img src="{{ Storage::url($seo->og_image) }}" class="cms-img-preview" alt="OG Image">
                @endif
                <input type="file" name="og_image" class="cms-input" accept="image/*">
            </div>
            <div class="cms-field">
                <label class="cms-label">Google Analytics ID</label>
                <input type="text" name="ga_tracking_id" value="{{ old('ga_tracking_id', $seo->ga_tracking_id) }}" class="cms-input" placeholder="G-XXXXXXXXXX">
            </div>
        </div>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">Custom Scripts</div>
        <div class="cms-field">
            <label class="cms-label">Script di &lt;head&gt;</label>
            <textarea name="custom_script_head" rows="4" class="cms-input" style="font-family:monospace;font-size:12px">{{ old('custom_script_head', $seo->custom_script_head) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Script di &lt;body&gt;</label>
            <textarea name="custom_script_body" rows="4" class="cms-input" style="font-family:monospace;font-size:12px">{{ old('custom_script_body', $seo->custom_script_body) }}</textarea>
        </div>
    </div>

</form>
@endsection
