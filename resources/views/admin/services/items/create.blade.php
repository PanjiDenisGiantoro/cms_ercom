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

        {{-- Nama & Subtitle --}}
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Item (Judul) <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="cms-input">
                @error('subtitle')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- Cover & Order --}}
        <div class="cms-form-row" style="margin-top:18px">
            <div class="cms-field">
                <label class="cms-label">Cover Image</label>
                <input type="file" name="cover_image" class="cms-input" accept="image/*" data-filepond>
                @error('cover_image')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="cms-field" style="margin-top:18px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input ckeditor">{{ old('description') }}</textarea>
        </div>

        {{-- CTA (Hidden for now unless needed) --}}
        <div class="cms-form-row" style="margin-top:14px; display:none">
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
