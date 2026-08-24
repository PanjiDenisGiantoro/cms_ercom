@extends('layouts.admin')
@section('title', 'Sosmed & WhatsApp')
@section('page-title', 'Sosmed & WhatsApp')
@section('breadcrumb', 'Settings / Sosmed & WhatsApp')

@php
    $socialPlatforms = [
        'fa-brands fa-facebook-f' => 'Facebook',
        'fa-brands fa-instagram' => 'Instagram',
        'fa-brands fa-x-twitter' => 'X (Twitter)',
        'fa-brands fa-linkedin-in' => 'LinkedIn',
        'fa-brands fa-youtube' => 'YouTube',
        'fa-brands fa-tiktok' => 'TikTok',
        'fa-brands fa-whatsapp' => 'WhatsApp',
        'fa-brands fa-telegram' => 'Telegram',
        'fa-brands fa-threads' => 'Threads',
    ];
@endphp

@section('topbar-actions')
    <button form="social-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="social-form" method="POST" action="{{ route('admin.social.update') }}">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">WhatsApp</div>
        <div class="cms-field">
            <label class="cms-label">Nomor WhatsApp</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $navbar->whatsapp_number) }}" class="cms-input" placeholder="6281234567890">
        </div>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">Social Media</div>
        <div id="social-items">
            @foreach(old('social_media', $footer->social_media ?? []) as $i => $item)
                <div class="cms-form-row" style="margin-top:{{ $i > 0 ? '12px' : '0' }};align-items:flex-end">
                    <div class="cms-field">
                        <label class="cms-label">Platform</label>
                        <div style="display:flex;align-items:center;gap:10px">
                            <i id="social-icon-preview-{{ $i }}" class="{{ $item['icon'] ?? '' }}" style="font-size:18px;width:22px;text-align:center;color:#2d3f55"></i>
                            <select name="social_media[{{ $i }}][icon]" class="cms-input" onchange="this.form.querySelector('[name=\'social_media[{{ $i }}][label]\']').value = this.options[this.selectedIndex].dataset.label ?? ''; document.getElementById('social-icon-preview-{{ $i }}').className = this.value">
                                <option value="">Pilih platform</option>
                                @foreach($socialPlatforms as $icon => $label)
                                    <option value="{{ $icon }}" data-label="{{ $label }}" {{ ($item['icon'] ?? '') === $icon ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
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
        options += `<option value="${icon}" data-label="${label}">${label}</option>`;
    }

    row.innerHTML = `
        <div class="cms-field">
            <label class="cms-label">Platform</label>
            <div style="display:flex;align-items:center;gap:10px">
                <i id="social-icon-preview-${socialItemIndex}" class="" style="font-size:18px;width:22px;text-align:center;color:#2d3f55"></i>
                <select name="social_media[${socialItemIndex}][icon]" class="cms-input" onchange="this.form.querySelector('[name=\\'social_media[${socialItemIndex}][label]\\']').value = this.options[this.selectedIndex].dataset.label ?? ''; document.getElementById('social-icon-preview-${socialItemIndex}').className = this.value">
                    ${options}
                </select>
            </div>
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
</script>
@endpush
