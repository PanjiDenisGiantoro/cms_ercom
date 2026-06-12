@extends('layouts.admin')
@section('title', 'Edit Anggota Tim')
@section('page-title', 'Edit Anggota Tim')
@section('breadcrumb', 'Social Proof / Team / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.team.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.team.update', $team) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $team->name) }}" class="cms-input">
            </div>
            <div class="cms-field">
                <label class="cms-label">Posisi <span class="cms-required">*</span></label>
                <input type="text" name="position" value="{{ old('position', $team->position) }}" class="cms-input">
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Foto</label>
                @if($team->photo)
                    <img src="{{ Storage::url($team->photo) }}" class="cms-img-preview" alt="Foto">
                @endif
                <input type="file" name="photo" class="cms-input" accept="image/*">
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', $team->order) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $team->is_active ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
</form>
@endsection
