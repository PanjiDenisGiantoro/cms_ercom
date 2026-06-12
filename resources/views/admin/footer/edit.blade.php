@extends('layouts.admin')
@section('title', 'Footer')
@section('page-title', 'Footer')
@section('breadcrumb', 'Settings / Footer')

@section('topbar-actions')
    <button form="footer-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="footer-form" method="POST" action="{{ route('admin.footer.update') }}">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">CTA & Kontak</div>
        <div class="cms-field">
            <label class="cms-label">CTA Headline</label>
            <input type="text" name="cta_headline" value="{{ old('cta_headline', $footer->cta_headline) }}" class="cms-input">
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Nomor Telepon</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $footer->phone_number) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $footer->email) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Alamat</label>
            <textarea name="address" rows="2" class="cms-input">{{ old('address', $footer->address) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Google Maps URL</label>
            <input type="url" name="google_maps_url" value="{{ old('google_maps_url', $footer->google_maps_url) }}" class="cms-input" placeholder="https://maps.google.com/...">
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Copyright Text</label>
            <input type="text" name="copyright_text" value="{{ old('copyright_text', $footer->copyright_text) }}" class="cms-input" placeholder="© 2025 Company Name">
        </div>
    </div>

</form>
@endsection
