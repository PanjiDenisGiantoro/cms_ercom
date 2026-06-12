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
            <textarea name="headline" rows="2" class="cms-input">{{ old('headline', $about->headline) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="5" class="cms-input">{{ old('description', $about->description) }}</textarea>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Tahun Berdiri</label>
                <input type="text" name="year_established" value="{{ old('year_established', $about->year_established) }}" class="cms-input" placeholder="2018">
            </div>
            <div class="cms-field">
                <label class="cms-label">Video URL</label>
                <input type="url" name="video_url" value="{{ old('video_url', $about->video_url) }}" class="cms-input" placeholder="https://youtube.com/...">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Background Image</label>
            @if($about->background_image)
                <img src="{{ Storage::url($about->background_image) }}" class="cms-img-preview" alt="Background">
            @endif
            <input type="file" name="background_image" class="cms-input" accept="image/*">
        </div>
    </div>

</form>
@endsection
