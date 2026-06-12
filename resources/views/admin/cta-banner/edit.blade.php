@extends('layouts.admin')
@section('title', 'CTA Banner')
@section('page-title', 'CTA Banner')
@section('breadcrumb', 'Settings / CTA Banner')

@section('topbar-actions')
    <button form="cta-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="cta-form" method="POST" action="{{ route('admin.cta-banner.update') }}">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">Konten CTA</div>
        <div class="cms-field">
            <label class="cms-label">Headline</label>
            <input type="text" name="headline" value="{{ old('headline', $ctaBanner->headline) }}" class="cms-input">
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Subtext</label>
            <textarea name="subtext" rows="3" class="cms-input">{{ old('subtext', $ctaBanner->subtext) }}</textarea>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Button Text</label>
                <input type="text" name="button_text" value="{{ old('button_text', $ctaBanner->button_text) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Button URL</label>
                <input type="url" name="button_url" value="{{ old('button_url', $ctaBanner->button_url) }}" class="cms-input" placeholder="https://...">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Available Status</label>
            <input type="text" name="available_status" value="{{ old('available_status', $ctaBanner->available_status) }}" class="cms-input" placeholder="Available for work">
        </div>
    </div>

</form>
@endsection
