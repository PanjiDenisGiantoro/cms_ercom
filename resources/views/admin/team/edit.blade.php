@extends('layouts.admin')
@section('title', 'Edit Anggota Tim')
@section('page-title', 'Edit Anggota Tim')
@section('breadcrumb', 'Social Proof / Team / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.team.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.team.update', $team) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $team->name) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Posisi <span class="cms-required">*</span></label>
                <input type="text" name="position" value="{{ old('position', $team->position) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Whatsapp</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $team->whatsapp) }}" class="cms-input @error('whatsapp') is-error @enderror" placeholder="6281234567890">
                @error('whatsapp')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $team->email) }}" class="cms-input @error('email') is-error @enderror">
                @error('email')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Foto</label>
                <input type="file" name="photo" class="cms-input" accept="image/*" data-filepond
                    @if($team->photo) data-current-file="{{ Storage::url($team->photo) }}" @endif>
            </div>
            <div class="cms-field">
                <label class="cms-label">Foto Background</label>
                <input type="file" name="background_image" class="cms-input" accept="image/*" data-filepond
                    @if($team->background_image) data-current-file="{{ Storage::url($team->background_image) }}" @endif>
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $team->order) }}" class="cms-input" min="0">
            </div>
            <div class="cms-field">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $team->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
