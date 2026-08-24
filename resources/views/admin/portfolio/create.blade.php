@extends('layouts.admin')
@section('title', 'Tambah Portfolio')
@section('page-title', 'Tambah Portfolio')
@section('breadcrumb', 'Content / Portfolio / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.portfolio.index') }}" class="cms-btn">Kembali</a>
    <button form="portfolio-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="portfolio-form" method="POST" action="{{ route('admin.portfolio.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Judul Project <span class="cms-required">*</span></label>
            <input type="text" name="project_title" value="{{ old('project_title') }}" class="cms-input @error('project_title') is-error @enderror">
            @error('project_title')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Kategori Service</label>
                <select name="service_category_id" class="cms-input">
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('service_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="cms-field">
                <label class="cms-label">Nama Klien</label>
                <input type="text" name="client_name" value="{{ old('client_name') }}" class="cms-input">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Project URL</label>
                <input type="url" name="project_url" value="{{ old('project_url') }}" class="cms-input" placeholder="https://...">
            </div>
            <div class="cms-field">
                <label class="cms-label">Tanggal Project</label>
                <input type="date" name="project_date" value="{{ old('project_date') }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="5" class="cms-input ckeditor">{{ old('description') }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Cover Image</label>
            <input type="file" name="cover_image" class="cms-input" accept="image/*" data-filepond>
        </div>

        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Preview Video</label>
            <div style="display:flex;gap:0;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;margin-bottom:12px">
                <button type="button" id="tab-upload" onclick="switchVideoTab('upload')"
                    style="flex:1;padding:8px;font-size:12px;font-weight:600;background:#1a2332;color:#fff;border:none;cursor:pointer">
                    Upload File
                </button>
                <button type="button" id="tab-link" onclick="switchVideoTab('link')"
                    style="flex:1;padding:8px;font-size:12px;font-weight:600;background:#f8fafc;color:#64748b;border:none;cursor:pointer">
                    Link URL
                </button>
            </div>

            <div id="panel-upload">
                <input type="file" name="video_file" class="cms-input" accept="video/mp4,video/mov,video/avi,video/webm" data-filepond>
                @error('video_file')<span class="cms-error">{{ $message }}</span>@enderror
            </div>

            <div id="panel-link" style="display:none">
                <input type="url" name="preview_video" value="{{ old('preview_video') }}" class="cms-input"
                    placeholder="https://youtube.com/watch?v=... atau https://vimeo.com/...">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px">YouTube, Vimeo, atau URL video langsung</div>
                @error('preview_video')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="display:flex;gap:24px;margin-top:16px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
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
    document.getElementById('panel-link').style.display  = isUpload ? 'none' : 'block';
    document.getElementById('tab-upload').style.background = isUpload ? '#1a2332' : '#f8fafc';
    document.getElementById('tab-upload').style.color     = isUpload ? '#fff' : '#64748b';
    document.getElementById('tab-link').style.background  = isUpload ? '#f8fafc' : '#1a2332';
    document.getElementById('tab-link').style.color       = isUpload ? '#64748b' : '#fff';
    if (isUpload) {
        document.querySelector('[name="preview_video"]').value = '';
    } else {
        const pond = window.filePondInstances && window.filePondInstances['video_file'];
        if (pond) pond.removeFiles(); else document.querySelector('[name="video_file"]').value = '';
    }
}
</script>
@endpush
