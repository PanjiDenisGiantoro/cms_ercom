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
                <input type="file" name="thumbnail" class="cms-input" accept="image/*" data-filepond>
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
    if (isUpload) {
        document.querySelector('[name="preview_video"]').value = '';
    } else {
        const pond = window.filePondInstances && window.filePondInstances['video_file'];
        if (pond) pond.removeFiles(); else document.querySelector('[name="video_file"]').value = '';
    }
}
</script>
@endpush
