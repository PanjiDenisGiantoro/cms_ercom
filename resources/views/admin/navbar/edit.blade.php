@extends('layouts.admin')
@section('title', 'Navbar')
@section('page-title', 'Navbar')
@section('breadcrumb', 'Settings / Navbar')

@section('topbar-actions')
    <button form="navbar-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="navbar-form" method="POST" action="{{ route('admin.navbar.update') }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="cms-card">
        <div class="cms-card-title">Logo</div>
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Logo (Light)</label>
                @if($navbar->logo_light)
                    <img src="{{ Storage::url($navbar->logo_light) }}" class="cms-img-preview" alt="Logo Light">
                @endif
                <input type="file" name="logo_light" class="cms-input" accept="image/*">
            </div>
            <div class="cms-field">
                <label class="cms-label">Logo (Dark)</label>
                @if($navbar->logo_dark)
                    <img src="{{ Storage::url($navbar->logo_dark) }}" class="cms-img-preview" alt="Logo Dark">
                @endif
                <input type="file" name="logo_dark" class="cms-input" accept="image/*">
            </div>
        </div>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">Menu</div>
        <div id="menu-items">
            @foreach(old('menu_items', $navbar->menu_items ?? []) as $i => $item)
                <div class="cms-form-row" style="margin-top:{{ $i > 0 ? '12px' : '0' }};align-items:flex-end">
                    <div class="cms-field">
                        <label class="cms-label">Label</label>
                        <input type="text" name="menu_items[{{ $i }}][label]" value="{{ $item['label'] ?? '' }}" class="cms-input" placeholder="Beranda">
                    </div>
                    <div class="cms-field" style="flex-direction:row;gap:8px;align-items:flex-end">
                        <div class="cms-field" style="flex:1">
                            <label class="cms-label">URL</label>
                            <input type="text" name="menu_items[{{ $i }}][url]" value="{{ $item['url'] ?? '' }}" class="cms-input" placeholder="/about">
                        </div>
                        <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="this.closest('.cms-form-row').remove()">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="cms-btn cms-btn-sm" style="margin-top:14px" onclick="addMenuItem()">+ Tambah Menu</button>
    </div>

    <div class="cms-card">
        <div class="cms-card-title">CTA & Kontak</div>
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">CTA Text</label>
                <input type="text" name="cta_text" value="{{ old('cta_text', $navbar->cta_text) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">CTA URL</label>
                <input type="url" name="cta_url" value="{{ old('cta_url', $navbar->cta_url) }}" class="cms-input" placeholder="https://...">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Nomor WhatsApp</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $navbar->whatsapp_number) }}" class="cms-input" placeholder="6281234567890">
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="sticky_on_scroll" value="0">
                <input type="checkbox" name="sticky_on_scroll" value="1" {{ old('sticky_on_scroll', $navbar->sticky_on_scroll) ? 'checked' : '' }}>
                <span>Sticky saat scroll</span>
            </label>
        </div>
    </div>

</form>
@endsection

@push('scripts')
<script>
let menuItemIndex = {{ count(old('menu_items', $navbar->menu_items ?? [])) }};

function addMenuItem() {
    const wrapper = document.getElementById('menu-items');
    const row = document.createElement('div');
    row.className = 'cms-form-row';
    row.style.marginTop = '12px';
    row.style.alignItems = 'flex-end';
    row.innerHTML = `
        <div class="cms-field">
            <label class="cms-label">Label</label>
            <input type="text" name="menu_items[${menuItemIndex}][label]" class="cms-input" placeholder="Beranda">
        </div>
        <div class="cms-field" style="flex-direction:row;gap:8px;align-items:flex-end">
            <div class="cms-field" style="flex:1">
                <label class="cms-label">URL</label>
                <input type="text" name="menu_items[${menuItemIndex}][url]" class="cms-input" placeholder="/about">
            </div>
            <button type="button" class="cms-btn cms-btn-danger cms-btn-sm" onclick="this.closest('.cms-form-row').remove()">Hapus</button>
        </div>
    `;
    wrapper.appendChild(row);
    menuItemIndex++;
}
</script>
@endpush