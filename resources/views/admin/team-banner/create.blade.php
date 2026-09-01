@extends('layouts.admin')
@section('title', 'Tambah Team Banner')
@section('page-title', 'Tambah Team Banner (Siluet)')
@section('breadcrumb', 'Social Proof / Team / Banner / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.team-banners.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.team-banners.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input" placeholder="Contoh: Founders">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Role / Posisi <span class="cms-required">*</span></label>
                <input type="text" name="role" value="{{ old('role') }}" class="cms-input" placeholder="Contoh: CEO & COO">
                @error('role')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Foto Siluet (PNG transparan) <span class="cms-required">*</span></label>
                <input type="file" name="image" class="cms-input" accept="image/*" data-filepond>
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>
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
