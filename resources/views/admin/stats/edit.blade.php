@extends('layouts.admin')
@section('title', 'Edit Stat')
@section('page-title', 'Edit Stat')
@section('breadcrumb', 'Content / Stats / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.stats.index') }}" class="cms-btn">Kembali</a>
    <button form="stat-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="stat-form" method="POST" action="{{ route('admin.stats.update', $stat) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Stat Number <span class="cms-required">*</span></label>
                <input type="text" name="stat_number" value="{{ old('stat_number', $stat->stat_number) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Stat Label <span class="cms-required">*</span></label>
                <input type="text" name="stat_label" value="{{ old('stat_label', $stat->stat_label) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Description</label>
            <textarea name="description" rows="2" class="cms-input" placeholder="More than 57 years in the field">{{ old('description', $stat->description) }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Avatar Images</label>
                @if($stat->avatar_images)
                    <div style="display:flex;gap:8px;margin-bottom:8px">
                        @foreach($stat->avatar_images as $avatar)
                            <img src="{{ Storage::url($avatar) }}" class="cms-img-preview" alt="Avatar">
                        @endforeach
                    </div>
                @endif
                <input type="file" name="avatar_images[]" class="cms-input" accept="image/*" multiple>
                <div style="font-size:11px;color:#94a3b8;margin-top:4px">Upload untuk mengganti semua avatar di atas</div>
                @error('avatar_images.*')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $stat->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $stat->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
