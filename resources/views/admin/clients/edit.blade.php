@extends('layouts.admin')
@section('title', 'Edit Client')
@section('page-title', 'Edit Client')
@section('breadcrumb', 'Social Proof / Client / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.clients.index') }}" class="cms-btn">Kembali</a>
    <button form="client-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="client-form" method="POST" action="{{ route('admin.clients.update', $client) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Client <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $client->name) }}" class="cms-input @error('name') is-error @enderror">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Kategori</label>
                <select name="category_id" class="cms-input @error('category_id') is-error @enderror">
                    <option value="">— Tanpa Kategori —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) old('category_id', $client->category_id) === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Website URL</label>
                <input type="url" name="website_url" value="{{ old('website_url', $client->website_url) }}" class="cms-input" placeholder="https://...">
                @error('website_url')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Logo</label>
                @if($client->logo_image)
                    <img src="{{ Storage::url($client->logo_image) }}" class="cms-img-preview" alt="Logo">
                @endif
                <input type="file" name="logo_image" class="cms-input" accept="image/*">
                @error('logo_image')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $client->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $client->is_active) ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
