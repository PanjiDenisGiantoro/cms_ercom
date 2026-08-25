@extends('layouts.admin')
@section('title', 'Tambah Anggota Tim')
@section('page-title', 'Tambah Anggota Tim')
@section('breadcrumb', 'Social Proof / Team / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.team.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Posisi <span class="cms-required">*</span></label>
                <input type="text" name="position" value="{{ old('position') }}" class="cms-input" placeholder="UI/UX Designer">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Whatsapp</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="cms-input @error('whatsapp') is-error @enderror" placeholder="6281234567890">
                @error('whatsapp')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="cms-input @error('email') is-error @enderror">
                @error('email')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Foto</label>
                <input type="file" name="photo" class="cms-input" accept="image/*" data-filepond>
            </div>
            <div class="cms-field">
                <label class="cms-label">Foto Siluet (PNG transparan)</label>
                <input type="file" name="photo_silhouette" class="cms-input" accept="image/png" data-filepond>
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
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
