@extends('layouts.admin')
@section('title', 'Tambah Kategori Blog')
@section('page-title', 'Tambah Kategori Blog')
@section('breadcrumb', 'Content / Blog / Kategori / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.blog-categories.index') }}" class="cms-btn">Kembali</a>
    <button form="blog-category-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="blog-category-form" method="POST" action="{{ route('admin.blog-categories.store') }}">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Kategori <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input @error('name') is-error @enderror">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
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
