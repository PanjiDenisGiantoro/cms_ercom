@extends('layouts.admin')
@section('title', 'About - Section 3')
@section('page-title', 'About - Section 3')
@section('breadcrumb', 'Settings / About / Section 3 / Pengaturan')

@section('topbar-actions')
    <a href="{{ route('admin.about-milestones.index') }}" class="cms-btn">Kembali</a>
    <button form="about-section3-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="about-section3-form" method="POST" action="{{ route('admin.about-section3.update') }}">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-card-title">Konten Section 3</div>
        <div class="cms-field">
            <label class="cms-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $setting->title) }}" class="cms-input @error('title') is-error @enderror">
            @error('title')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input">{{ old('description', $setting->description) }}</textarea>
            @error('description')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
    </div>
</form>
@endsection
