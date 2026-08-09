@extends('layouts.admin')
@section('title', 'Edit Sub-item')
@section('page-title', 'Edit Sub-item')
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / ' . $item->name . ' / Edit Sub-item')

@section('topbar-actions')
    <a href="{{ route('admin.services.items.sub-items.index', [$service, $item]) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
@php
    $isVideoFile = $subItem->preview_video && !str_starts_with($subItem->preview_video, 'http');
    $isVideoLink = $subItem->preview_video && str_starts_with($subItem->preview_video, 'http');
    $defaultTab  = $isVideoFile ? 'upload' : 'link';
@endphp

<form id="form" method="POST" action="{{ route('admin.services.items.sub-items.update', [$service, $item, $subItem]) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Sub-item <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $subItem->name) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $subItem->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Thumbnail</label>
                <input type="file" name="thumbnail" class="cms-input" accept="image/*" data-filepond
                    @if($subItem->thumbnail) data-current-file="{{ str_starts_with($subItem->thumbnail, 'http') ? $subItem->thumbnail : Storage::url($subItem->thumbnail) }}" @endif>
            </div>

            <div class="cms-field">
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
                            File saat ini: <strong>{{ basename($subItem->preview_video) }}</strong>
                        </div>
                    @endif
                    <input type="file" name="video_file" class="cms-input" accept="video/mp4,video/mov,video/avi,video/webm" data-filepond>
                    @error('video_file')<span class="cms-error">{{ $message }}</span>@enderror
                </div>

                <div id="panel-link" style="display:{{ $defaultTab==='link' ? 'block' : 'none' }}">
                    <input type="url" name="preview_video" value="{{ old('preview_video', $isVideoLink ? $subItem->preview_video : '') }}" class="cms-input"
                        placeholder="https://youtube.com/watch?v=... atau https://vimeo.com/...">
                    <div style="font-size:11px;color:#94a3b8;margin-top:4px">YouTube, Vimeo, atau URL video langsung</div>
                    @error('preview_video')<span class="cms-error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input ckeditor">{{ old('description', $subItem->description) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $subItem->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
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
