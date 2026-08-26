@extends('layouts.admin')
@section('title', 'Edit Portfolio')
@section('page-title', 'Edit Portfolio')
@section('breadcrumb', 'Content / Portfolio / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.portfolio.index') }}" class="cms-btn">Kembali</a>
    <button form="portfolio-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
@php
    $isVideoFile = $portfolio->preview_video && !str_starts_with($portfolio->preview_video, 'http');
    $isVideoLink = $portfolio->preview_video && str_starts_with($portfolio->preview_video, 'http');
    $defaultTab  = $isVideoFile ? 'upload' : 'link';
@endphp

<form id="portfolio-form" method="POST" action="{{ route('admin.portfolio.update', $portfolio) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Judul Project <span class="cms-required">*</span></label>
            <input type="text" name="project_title" value="{{ old('project_title', $portfolio->project_title) }}" class="cms-input">
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Kategori Service</label>
                <select name="service_category_id" class="cms-input">
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('service_category_id', $portfolio->service_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="cms-field">
                <label class="cms-label">Nama Klien</label>
                <input type="text" name="client_name" value="{{ old('client_name', $portfolio->client_name) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Project URL</label>
                <input type="url" name="project_url" value="{{ old('project_url', $portfolio->project_url) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Tanggal Project</label>
                <input type="date" name="project_date" value="{{ old('project_date', $portfolio->project_date?->format('Y-m-d')) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="5" class="cms-input ckeditor">{{ old('description', $portfolio->description) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Cover Image</label>
            <input type="file" name="cover_image" class="cms-input" accept="image/*" data-filepond
                @if($portfolio->cover_image) data-current-file="{{ Storage::url($portfolio->cover_image) }}" @endif>
        </div>

        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Preview Video</label>
            <div style="display:flex;gap:0;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;margin-bottom:12px">
                <button type="button" id="tab-upload" onclick="switchVideoTab('upload')"
                    style="flex:1;padding:8px;font-size:12px;font-weight:600;background:{{ $defaultTab==='upload' ? '#1a2332' : '#f8fafc' }};color:{{ $defaultTab==='upload' ? '#fff' : '#64748b' }};border:none;cursor:pointer">
                    Upload File
                </button>
                <button type="button" id="tab-link" onclick="switchVideoTab('link')"
                    style="flex:1;padding:8px;font-size:12px;font-weight:600;background:{{ $defaultTab==='link' ? '#1a2332' : '#f8fafc' }};color:{{ $defaultTab==='link' ? '#fff' : '#64748b' }};border:none;cursor:pointer">
                    Link URL
                </button>
            </div>

            <div id="panel-upload" style="display:{{ $defaultTab==='upload' ? 'block' : 'none' }}">
                @if($isVideoFile)
                    <div style="margin-bottom:8px;padding:10px 12px;background:#f0fdf4;border-radius:8px;font-size:12px;color:#166534">
                        File saat ini: <strong>{{ basename($portfolio->preview_video) }}</strong>
                    </div>
                @endif
                <input type="file" name="video_file" class="cms-input" accept="video/mp4,video/mov,video/avi,video/webm" data-filepond>
                @error('video_file')<span class="cms-error">{{ $message }}</span>@enderror
            </div>

            <div id="panel-link" style="display:{{ $defaultTab==='link' ? 'block' : 'none' }}">
                <input type="url" name="preview_video" value="{{ old('preview_video', $isVideoLink ? $portfolio->preview_video : '') }}" class="cms-input"
                    placeholder="https://youtube.com/watch?v=... atau https://vimeo.com/...">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px">YouTube, Vimeo, atau URL video langsung</div>
                @error('preview_video')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="margin-top:16px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $portfolio->is_published) ? 'checked' : '' }}>
                <span>Published</span>
            </label>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function switchVideoTab(tab) {
    const isUpload = tab === 'upload';
    document.getElementById('panel-upload').style.display = isUpload ? 'block' : 'none';
    document.getElementById('panel-link').style.display   = isUpload ? 'none'  : 'block';
    document.getElementById('tab-upload').style.background = isUpload ? '#1a2332' : '#f8fafc';
    document.getElementById('tab-upload').style.color      = isUpload ? '#fff'    : '#64748b';
    document.getElementById('tab-link').style.background   = isUpload ? '#f8fafc' : '#1a2332';
    document.getElementById('tab-link').style.color        = isUpload ? '#64748b' : '#fff';
    if (isUpload) {
        document.querySelector('[name="preview_video"]').value = '';
    } else {
        const pond = window.filePondInstances && window.filePondInstances['video_file'];
        if (pond) pond.removeFiles(); else document.querySelector('[name="video_file"]').value = '';
    }
}
</script>
@endpush
