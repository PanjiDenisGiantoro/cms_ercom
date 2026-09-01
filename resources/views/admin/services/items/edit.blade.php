@extends('layouts.admin')
@section('title', 'Edit Service Item')
@section('page-title', 'Edit Service Item')
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / Edit Item')

@section('topbar-actions')
    <a href="{{ route('admin.services.items.index', $service) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.services.items.update', [$service, $item]) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">

        {{-- Nama & Subtitle --}}
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Item (Judul) <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" class="cms-input">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $item->subtitle) }}" class="cms-input">
                @error('subtitle')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- Cover & Order --}}
        <div class="cms-form-row" style="margin-top:18px">
            <div class="cms-field">
                <label class="cms-label">Cover Image</label>
                <input type="file" name="cover_image" class="cms-input" accept="image/*" data-filepond
                    @if($item->cover_image) data-current-file="{{ Storage::url($item->cover_image) }}" @endif>
                @error('cover_image')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $item->order) }}" class="cms-input" min="0">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="cms-field" style="margin-top:18px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input ckeditor">{{ old('description', $item->description) }}</textarea>
        </div>

        {{-- CTA (Hidden) --}}
        <div class="cms-form-row" style="margin-top:14px; display:none">
            <div class="cms-field">
                <label class="cms-label">CTA Text</label>
                <input type="text" name="cta_text" value="{{ old('cta_text', $item->cta_text) }}" class="cms-input" placeholder="Lihat Selengkapnya">
            </div>
            <div class="cms-field">
                <label class="cms-label">CTA URL</label>
                <input type="url" name="cta_url" value="{{ old('cta_url', $item->cta_url) }}" class="cms-input" placeholder="https://...">
            </div>
        </div>

        {{-- Status --}}
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>

    </div>
</form>

<div class="cms-card" style="margin-top:24px;">
    <h3 style="font-size:18px; font-weight:600; margin-bottom:8px;">Galeri & Media</h3>
    <p style="margin-bottom:16px;color:#666;font-size:14px;">Kelola foto/video khusus untuk item ini.</p>
    <a href="{{ route('admin.service-media.index', ['type' => 'item', 'id' => $item->id]) }}" class="cms-btn cms-btn-primary">Kelola Media ({{ $item->media()->count() }})</a>
</div>
@endsection
