@extends('layouts.admin')
@section('title', 'Edit Sub-item')
@section('page-title', 'Edit Sub-item')
@section('breadcrumb', 'Content / Services / ' . $service->name . ' / ' . $item->name . ' / Edit Sub-item')

@section('topbar-actions')
    <a href="{{ route('admin.services.items.sub-items.index', [$service, $item]) }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.services.items.sub-items.update', [$service, $item, $subItem]) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama Sub-item <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $subItem->name) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $subItem->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Thumbnail</label>
            @if($subItem->thumbnail)
                <img src="{{ Storage::url($subItem->thumbnail) }}" class="cms-img-preview" alt="Thumbnail">
            @endif
            <input type="file" name="thumbnail" class="cms-input" accept="image/*">
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="description" rows="4" class="cms-input">{{ old('description', $subItem->description) }}</textarea>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $subItem->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
