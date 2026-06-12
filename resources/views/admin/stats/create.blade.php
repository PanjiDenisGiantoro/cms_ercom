@extends('layouts.admin')
@section('title', 'Tambah Stat')
@section('page-title', 'Tambah Stat')
@section('breadcrumb', 'Content / Stats / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.stats.index') }}" class="cms-btn">Kembali</a>
    <button form="stat-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="stat-form" method="POST" action="{{ route('admin.stats.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Stat Number <span class="cms-required">*</span></label>
                <input type="text" name="stat_number" value="{{ old('stat_number') }}" class="cms-input @error('stat_number') is-error @enderror" placeholder="150+">
                @error('stat_number')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Stat Label <span class="cms-required">*</span></label>
                <input type="text" name="stat_label" value="{{ old('stat_label') }}" class="cms-input @error('stat_label') is-error @enderror" placeholder="Projects Done">
                @error('stat_label')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Description</label>
            <textarea name="description" rows="2" class="cms-input" placeholder="More than 57 years in the field">{{ old('description') }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Avatar Images</label>
                <input type="file" name="avatar_images[]" class="cms-input" accept="image/*" multiple>
                @error('avatar_images.*')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>
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
