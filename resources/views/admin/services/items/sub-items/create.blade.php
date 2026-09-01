@extends('layouts.admin')
@section('title', 'Tambah Sub Item')
@section('page-title', 'Tambah Sub Item')
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / ' . $item->name . ' / Tambah Sub')

@section('topbar-actions')
    <a href="{{ route('admin.services.items.sub-items.index', [$service, $item]) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.services.items.sub-items.store', [$service, $item]) }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        
        {{-- Nama & Subtitle --}}
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Sub Item (Judul) <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="cms-input">
                @error('subtitle')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- Cover & Order --}}
        <div class="cms-form-row" style="margin-top:18px">
            <div class="cms-field">
                <label class="cms-label">Cover Image</label>
                <input type="file" name="cover_image" class="cms-input" accept="image/*" data-filepond>
                @error('cover_image')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="cms-field" style="margin-top:18px">
            <label class="cms-label">Deskripsi Singkat</label>
            <textarea name="description" rows="3" class="cms-input">{{ old('description') }}</textarea>
        </div>

        {{-- Status --}}
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked>
                <span>Aktif</span>
            </label>
        </div>

    </div>
</form>
@endsection
