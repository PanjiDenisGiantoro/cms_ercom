@extends('layouts.admin')
@section('title', 'Pengaturan Contact')
@section('page-title', 'Pengaturan Contact')
@section('breadcrumb', 'Content / Contact')

@php
    $socialPlatforms = [
        '📘' => 'Facebook',
        '📷' => 'Instagram',
        '𝕏' => 'X (Twitter)',
        'in' => 'LinkedIn',
        '▶' => 'YouTube',
        '🎵' => 'TikTok',
        '💬' => 'WhatsApp',
        '✈' => 'Telegram',
        '🧵' => 'Threads',
    ];
@endphp

@section('topbar-actions')
    <button form="contact-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="contact-form" method="POST" action="{{ route('admin.contacts.update') }}">
    @csrf @method('PUT')

    {{-- Contact Info --}}
    <div class="cms-card">
        <div class="cms-card-title">Informasi Contact</div>
        <div class="cms-field">
            <label class="cms-label">Label</label>
            <input type="text" name="label" value="{{ old('label', $contact->label) }}" class="cms-input" placeholder="Kantor Pusat">
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Alamat</label>
                <input type="text" name="address" value="{{ old('address', $contact->address) }}" class="cms-input" placeholder="Jl. Sudirman No. 123">
            </div>
            <div class="cms-field">
                <label class="cms-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="cms-input" placeholder="+62 21 1234567">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="cms-input" placeholder="info@ercommunication.id">
        </div>
    </div>

    {{-- Maps --}}
    <div class="cms-card">
        <div class="cms-card-title">Google Maps</div>
        <div class="cms-field">
            <label class="cms-label">Map Embed URL</label>
            <input type="text" name="map_embed_url" id="embed-input" value="{{ old('map_embed_url', $contact->map_embed_url) }}" class="cms-input" placeholder="https://www.google.com/maps/embed?..." oninput="updateEmbedPreview()">
        </div>
        <div id="embed-preview" style="margin-top:14px;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;display:{{ $contact->map_embed_url ? 'block' : 'none' }}">
            <iframe
                id="embed-iframe"
                src="{{ $contact->map_embed_url }}"
                style="width:100%;height:300px;border:none;"
                allowfullscreen
                loading="lazy"
            ></iframe>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Latitude</label>
                <input type="text" name="latitude" id="lat-input" value="{{ old('latitude', $contact->latitude) }}" class="cms-input" placeholder="-6.2088" oninput="updateMapPreview()">
                @error('latitude')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Longitude</label>
                <input type="text" name="longitude" id="lng-input" value="{{ old('longitude', $contact->longitude) }}" class="cms-input" placeholder="106.8456" oninput="updateMapPreview()">
                @error('longitude')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div id="map-preview" style="margin-top:14px;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;display:{{ ($contact->latitude && $contact->longitude) ? 'block' : 'none' }}">
            <iframe
                id="map-iframe"
                src="{{ ($contact->latitude && $contact->longitude) ? 'https://maps.google.com/maps?q='.$contact->latitude.','.$contact->longitude.'&z=15&output=embed' : '' }}"
                style="width:100%;height:300px;border:none;"
                allowfullscreen
                loading="lazy"
            ></iframe>
        </div>
    </div>

    {{-- WhatsApp --}}
    <div class="cms-card">
        <div class="cms-card-title">WhatsApp</div>
        <div class="cms-field">
            <label class="cms-label">Nomor WhatsApp</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $navbar->whatsapp_number) }}" class="cms-input" placeholder="6281234567890">
            <div style="font-size:11px;color:#94a3b8;margin-top:4px">Format: kode negara + nomor, tanpa + atau spasi. Contoh: 6281234567890</div>
        </div>
    </div>

    {{-- Social Media --}}
    <div class="cms-card">
        <div class="cms-card-title">Social Media</div>
        <div id="social-items">
            @foreach(old('social_media', $footer->social_media ?? []) as $i => $item)
                <div class="cms-form-row" style="margin-top:{{ $i > 0 ? '12px' : '0' }};align-items:flex-end">
                    <div class="cms-field">
                        <label class="cms-label">Platform</label>
                        <select name="social_media[{{ $i }}][icon]" class="cms-input" onchange="this.form.querySelector('[name=\'social_media[{{ $i }}][label]\']').value = this.options[this.selectedIndex].dataset.label ?? ''">
                            <option value="">Pilih platform</option>
                            @foreach($socialPlatforms as $icon => $label)
                                <option value="{{ $icon }}" data-label="{{ $label }}" {{ ($item['icon'] ?? '') === $icon ? 'selected' : '' }}>{{ $icon }} {{ $label }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="social_media[{{ $i }}][label]" value="{{ $item['label'] ?? '' }}">
                    </div>
                    <div class="cms-field" style="flex-direction:row;gap:8px;align-items:flex-end">
                        <div class="cms-field" style="flex:1">
                            <label class="cms-label">URL</label>
                            <input type="url" name="social_media[{{ $i }}][url]" value="{{ $item['url'] ?? '' }}" class="cms-input" placeholder="https://instagram.com/...">
                        </div>
                        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="this.closest('.cms-form-row').remove()">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="cms-btn cms-btn-sm" style="margin-top:14px" onclick="addSocialItem()">+ Tambah Social Media</button>
    </div>

    {{-- Copyright Text --}}
    <div class="cms-card">
        <div class="cms-card-title">Copyright</div>
        <div class="cms-field">
            <label class="cms-label">Copyright Text</label>
            <input type="text" name="copyright_text" value="{{ old('copyright_text', $footer->copyright_text) }}" class="cms-input" placeholder="© 2025 Company Name">
        </div>
    </div>

</form>
@endsection

@push('scripts')
<script>
let socialItemIndex = {{ count(old('social_media', $footer->social_media ?? [])) }};
const socialPlatforms = @json($socialPlatforms);

function addSocialItem() {
    const wrapper = document.getElementById('social-items');
    const row = document.createElement('div');
    row.className = 'cms-form-row';
    row.style.marginTop = '12px';
    row.style.alignItems = 'flex-end';

    let options = '<option value="">Pilih platform</option>';
    for (const [icon, label] of Object.entries(socialPlatforms)) {
        options += `<option value="${icon}" data-label="${label}">${icon} ${label}</option>`;
    }

    row.innerHTML = `
        <div class="cms-field">
            <label class="cms-label">Platform</label>
            <select name="social_media[${socialItemIndex}][icon]" class="cms-input" onchange="this.nextElementSibling.value = this.options[this.selectedIndex].dataset.label ?? ''">
                ${options}
            </select>
            <input type="hidden" name="social_media[${socialItemIndex}][label]" value="">
        </div>
        <div class="cms-field" style="flex-direction:row;gap:8px;align-items:flex-end">
            <div class="cms-field" style="flex:1">
                <label class="cms-label">URL</label>
                <input type="url" name="social_media[${socialItemIndex}][url]" class="cms-input" placeholder="https://instagram.com/...">
            </div>
            <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="this.closest('.cms-form-row').remove()">Hapus</button>
        </div>
    `;
    wrapper.appendChild(row);
    socialItemIndex++;
}

function updateMapPreview() {
    const lat = document.getElementById('lat-input').value;
    const lng = document.getElementById('lng-input').value;
    const preview = document.getElementById('map-preview');
    const iframe = document.getElementById('map-iframe');

    if (lat && lng && !isNaN(lat) && !isNaN(lng)) {
        iframe.src = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}

function updateEmbedPreview() {
    const url = document.getElementById('embed-input').value;
    const preview = document.getElementById('embed-preview');
    const iframe = document.getElementById('embed-iframe');
    
    if (url && url.startsWith('http')) {
        iframe.src = url;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endpush
