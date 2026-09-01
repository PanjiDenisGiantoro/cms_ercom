@extends('layouts.admin')
@section('title', 'Edit Media')
@section('page-title', 'Edit Media - ' . $parent->name)
@section('breadcrumb', 'Services / Media / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.service-media.index', ['type' => $type, 'id' => $id]) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.service-media.update', $serviceMedia) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Tipe Media <span class="cms-required">*</span></label>
            <select name="media_type" class="cms-input" id="media_type" onchange="toggleFields()">
                <option value="photo" {{ old('media_type', $serviceMedia->media_type) === 'photo' ? 'selected' : '' }}>Foto (Upload)</option>
                <option value="youtube" {{ old('media_type', $serviceMedia->media_type) === 'youtube' ? 'selected' : '' }}>Video (YouTube Link)</option>
                <option value="video" {{ old('media_type', $serviceMedia->media_type) === 'video' ? 'selected' : '' }}>Video (Upload MP4)</option>
            </select>
        </div>

        <div id="field_file" class="cms-field" style="margin-top:14px">
            <label class="cms-label">File Media (Foto / Video) <span class="cms-required">*</span></label>
            <input type="file" name="file_path" class="cms-input" data-filepond
                @if($serviceMedia->file_path) data-current-file="{{ Storage::url($serviceMedia->file_path) }}" @endif>
            <small class="cms-hint">Format didukung: JPG, PNG, WEBP (untuk Foto) / MP4 (untuk Video).</small>
        </div>

        <div id="field_youtube" class="cms-field" style="margin-top:14px; display:none;">
            <label class="cms-label">URL YouTube <span class="cms-required">*</span></label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url', $serviceMedia->youtube_url) }}" class="cms-input" placeholder="https://youtube.com/watch?v=...">
        </div>

        <div id="field_thumbnail" class="cms-form-row" style="margin-top:14px; display:none;">
            <div class="cms-field">
                <label class="cms-label">Cover / Thumbnail Video</label>
                <input type="file" name="thumbnail_path" class="cms-input" accept="image/*" data-filepond
                    @if($serviceMedia->thumbnail_path) data-current-file="{{ Storage::url($serviceMedia->thumbnail_path) }}" @endif>
                <small class="cms-hint">Biarkan jika tidak ingin mengubah cover.</small>
            </div>
            <div class="cms-field"></div>
        </div>

        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Order</label>
            <input type="number" name="order" value="{{ old('order', $serviceMedia->order) }}" class="cms-input" min="0">
        </div>
    </div>
</form>

<script>
    function toggleFields() {
        const type = document.getElementById('media_type').value;
        const fileField = document.getElementById('field_file');
        const youtubeField = document.getElementById('field_youtube');
        const thumbField = document.getElementById('field_thumbnail');

        if (type === 'photo') {
            fileField.style.display = 'block';
            youtubeField.style.display = 'none';
            thumbField.style.display = 'none';
        } else if (type === 'youtube') {
            fileField.style.display = 'none';
            youtubeField.style.display = 'block';
            thumbField.style.display = 'flex';
        } else if (type === 'video') {
            fileField.style.display = 'block';
            youtubeField.style.display = 'none';
            thumbField.style.display = 'flex';
        }
    }
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
