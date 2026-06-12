@extends('layouts.admin')
@section('title', 'Tambah Service Item')
@section('page-title', 'Tambah Service Item')
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / Tambah Item')

@section('topbar-actions')
    <a href="{{ route('admin.services.items.index', $service) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.services.items.store', $service) }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">

        {{-- Nama & Order --}}
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Item <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>

        {{-- Foto & Video --}}
        <div class="cms-form-row" style="margin-top:18px">

            {{-- Foto --}}
            <div class="cms-field">
                <label class="cms-label">Foto / Thumbnail</label>
                <label style="display:flex;align-items:center;justify-content:center;flex-direction:column;gap:8px;border:2px dashed #e2e8f0;border-radius:10px;padding:20px;cursor:pointer;transition:border-color .2s" id="photo-drop">
                    <svg viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="#94a3b8" style="width:28px;height:28px"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    <span style="font-size:12px;color:#94a3b8">Klik untuk upload foto</span>
                    <span style="font-size:11px;color:#cbd5e1">JPG, PNG, WEBP — max 4MB</span>
                    <input type="file" name="thumbnail" accept="image/*" style="display:none" onchange="previewPhoto(this,'photo-preview')">
                </label>
                <img id="photo-preview" src="" style="display:none;margin-top:8px;max-height:120px;border-radius:8px;object-fit:cover" alt="Preview">
                @error('thumbnail')<span class="cms-error">{{ $message }}</span>@enderror
            </div>

            {{-- Video --}}
            <div class="cms-field">
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
                    <label style="display:flex;align-items:center;justify-content:center;flex-direction:column;gap:8px;border:2px dashed #e2e8f0;border-radius:10px;padding:20px;cursor:pointer" id="video-drop">
                        <svg viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke="#94a3b8" style="width:28px;height:28px"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                        <span style="font-size:12px;color:#94a3b8">Klik untuk upload video</span>
                        <span style="font-size:11px;color:#cbd5e1">MP4, MOV, WEBM — max 100MB</span>
                        <input type="file" name="video_file" accept="video/mp4,video/mov,video/avi,video/webm" style="display:none" onchange="showVideoName(this)">
                    </label>
                    <div id="video-name" style="display:none;margin-top:6px;font-size:12px;color:#10b981;font-weight:500"></div>
                    @error('video_file')<span class="cms-error">{{ $message }}</span>@enderror
                </div>

                <div id="panel-link" style="display:none">
                    <input type="url" name="preview_video" value="{{ old('preview_video') }}" class="cms-input"
                        placeholder="https://youtube.com/watch?v=... atau https://vimeo.com/...">
                    <div style="font-size:11px;color:#94a3b8;margin-top:4px">YouTube, Vimeo, atau URL video langsung</div>
                    @error('preview_video')<span class="cms-error">{{ $message }}</span>@enderror
                </div>
            </div>

        </div>

        {{-- Deskripsi --}}
        <div class="cms-field" style="margin-top:18px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input">{{ old('description') }}</textarea>
        </div>

        {{-- CTA --}}
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">CTA Text</label>
                <input type="text" name="cta_text" value="{{ old('cta_text') }}" class="cms-input" placeholder="Lihat Selengkapnya">
            </div>
            <div class="cms-field">
                <label class="cms-label">CTA URL</label>
                <input type="url" name="cta_url" value="{{ old('cta_url') }}" class="cms-input" placeholder="https://...">
            </div>
        </div>

        {{-- Status --}}
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
    // clear the inactive input
    if (isUpload) document.querySelector('[name="preview_video"]').value = '';
    else document.querySelector('[name="video_file"]').value = '';
}
function previewPhoto(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}
function showVideoName(input) {
    const el = document.getElementById('video-name');
    if (input.files && input.files[0]) {
        el.textContent = '✓ ' + input.files[0].name;
        el.style.display = 'block';
    }
}
</script>
@endpush
