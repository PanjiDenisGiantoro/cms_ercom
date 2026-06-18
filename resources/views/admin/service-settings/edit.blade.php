@extends('layouts.admin')
@section('title', 'Services Header')
@section('page-title', 'Services Header')
@section('breadcrumb', 'Content / Services / Header')

@section('topbar-actions')
    <a href="{{ route('admin.services.index') }}" class="cms-btn">Kembali</a>
    <button form="service-settings-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="service-settings-form" method="POST" action="{{ route('admin.service-settings.update') }}">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">Header Halaman Services</div>
        <div class="cms-field">
            <label class="cms-label">Label</label>
            <textarea name="headline" class="cms-input ckeditor-minimal">{{ old('headline', $setting->headline) }}</textarea>
            @error('headline')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Sub Label</label>
            <textarea name="subtext" rows="3" class="cms-input ckeditor">{{ old('subtext', $setting->subtext) }}</textarea>
            @error('subtext')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
    </div>

</form>
@endsection
