@extends('layouts.admin')
@section('title', 'About')
@section('page-title', 'About')
@section('breadcrumb', 'Settings / About')

@section('topbar-actions')
    <button form="about-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="about-form" method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">Konten About</div>
        <div class="cms-field">
            <label class="cms-label">Headline</label>
            <textarea name="headline" rows="2" class="cms-input ckeditor-minimal">{{ old('headline', $about->headline) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="5" class="cms-input ckeditor">{{ old('description', $about->description) }}</textarea>
        </div>
    </div>

</form>
@endsection
