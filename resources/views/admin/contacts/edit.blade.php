@extends('layouts.admin')
@section('title', 'Edit Contact')
@section('page-title', 'Edit Contact')
@section('breadcrumb', 'Content / Contact / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.contacts.index') }}" class="cms-btn">Kembali</a>
    <button form="contact-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="contact-form" method="POST" action="{{ route('admin.contacts.update', $contact) }}">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Label <span class="cms-required">*</span></label>
            <input type="text" name="label" value="{{ old('label', $contact->label) }}" class="cms-input @error('label') is-error @enderror" placeholder="Head Office">
            @error('label')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Address</label>
            <input type="text" name="address" value="{{ old('address', $contact->address) }}" class="cms-input">
            @error('address')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="cms-input">
                @error('phone')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="cms-input">
                @error('email')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Map Embed URL</label>
            <textarea name="map_embed_url" rows="2" class="cms-input" placeholder="https://www.google.com/maps/embed?...">{{ old('map_embed_url', $contact->map_embed_url) }}</textarea>
            @error('map_embed_url')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Latitude</label>
                <input type="text" inputmode="decimal" id="contact-lat" name="latitude" value="{{ old('latitude', $contact->latitude) }}" class="cms-input" placeholder="-6.2088000">
                @error('latitude')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Longitude</label>
                <input type="text" inputmode="decimal" id="contact-lng" name="longitude" value="{{ old('longitude', $contact->longitude) }}" class="cms-input" placeholder="106.8456000">
                @error('longitude')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Preview GMaps</label>
            <iframe id="gmaps-preview" style="width:100%;height:280px;border:0;border-radius:8px" loading="lazy"></iframe>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $contact->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $contact->is_active) ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    const latInput = document.getElementById('contact-lat');
    const lngInput = document.getElementById('contact-lng');
    const preview = document.getElementById('gmaps-preview');

    function updatePreview() {
        const lat = parseFloat(latInput.value);
        const lng = parseFloat(lngInput.value);
        preview.src = (!isNaN(lat) && !isNaN(lng))
            ? `https://www.google.com/maps?q=${lat},${lng}&output=embed`
            : '';
    }

    latInput.addEventListener('input', updatePreview);
    lngInput.addEventListener('input', updatePreview);
    updatePreview();
})();
</script>
@endpush
