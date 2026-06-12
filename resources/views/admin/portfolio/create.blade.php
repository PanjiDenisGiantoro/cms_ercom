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
            <textarea name="description" rows="5" class="cms-input">{{ old('description') }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Cover Image</label>
            <input type="file" name="cover_image" class="cms-input" accept="image/*">
        </div>
        <div style="display:flex;gap:24px;margin-top:16px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                <span>Published</span>
            </label>
            <label class="cms-toggle-label">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <span>Featured</span>
            </label>
        </div>
    </div>
</form>
@endsection
