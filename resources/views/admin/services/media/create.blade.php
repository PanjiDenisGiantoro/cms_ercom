@extends('layouts.admin')
@section('title', 'Tambah Media')
@section('page-title', 'Tambah Media - ' . $parent->name)
@section('breadcrumb', 'Services / Media / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.service-media.index', ['type' => $type, 'id' => $id]) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.service-media.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="mediable_type" value="{{ $type }}">
    <input type="hidden" name="mediable_id" value="{{ $id }}">

    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Tipe Media <span class="cms-required">*</span></label>
            <select name="media_type" class="cms-input" id="media_type" onchange="toggleFields()">
                <option value="photo" {{ old('media_type') === 'photo' ? 'selected' : '' }}>Foto (Upload)</option>
                <option value="youtube" {{ old('media_type') === 'youtube' ? 'selected' : '' }}>Video (YouTube Link)</option>
                <option value="video" {{ old('media_type') === 'video' ? 'selected' : '' }}>Video (Upload MP4)</option>
            </select>
        </div>

        <div id="field_photo" class="cms-field" style="margin-top:14px">
            <label class="cms-label">Upload Foto <span class="cms-required">*</span></label>
            <input type="file" name="file_path[]" class="cms-input" data-filepond multiple accept="image/jpeg, image/png, image/webp">
            <small class="cms-hint">Format didukung: JPG, PNG, WEBP (Bisa pilih banyak file sekaligus).</small>
        </div>

        <div id="field_video" class="cms-field" style="margin-top:14px; display:none;">
            <label class="cms-label">File Video <span class="cms-required">*</span></label>
            <input type="file" name="file_path" class="cms-input" data-filepond accept="video/mp4, video/mov">
            <small class="cms-hint">Format didukung: MP4, MOV.</small>
        </div>

        <div id="field_youtube" class="cms-field" style="margin-top:14px; display:none;">
            <label class="cms-label">URL YouTube <span class="cms-required">*</span></label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" class="cms-input" placeholder="https://youtube.com/watch?v=...">
        </div>

        <div id="field_thumbnail" class="cms-form-row" style="margin-top:14px; display:none;">
            <div class="cms-field">
                <label class="cms-label">Cover / Thumbnail Video</label>
                <input type="file" name="thumbnail_path" class="cms-input" accept="image/*" data-filepond>
                <small class="cms-hint">Kosongkan jika ingin auto-generate (khusus format yang didukung).</small>
            </div>
            <div class="cms-field"></div>
        </div>

        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Order</label>
            <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
        </div>
    </div>
</form>

<script>
    function toggleFields() {
        const type = document.getElementById('media_type').value;
        const photoField = document.getElementById('field_photo');
        const videoField = document.getElementById('field_video');
        const youtubeField = document.getElementById('field_youtube');
        const thumbField = document.getElementById('field_thumbnail');

        if (type === 'photo') {
            photoField.style.display = 'block';
            videoField.style.display = 'none';
            youtubeField.style.display = 'none';
            thumbField.style.display = 'none';
        } else if (type === 'youtube') {
            photoField.style.display = 'none';
            videoField.style.display = 'none';
            youtubeField.style.display = 'block';
            thumbField.style.display = 'flex';
        } else if (type === 'video') {
            photoField.style.display = 'none';
            videoField.style.display = 'block';
            youtubeField.style.display = 'none';
            thumbField.style.display = 'flex';
        }
    }
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
