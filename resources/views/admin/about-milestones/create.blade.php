@extends('layouts.admin')
@section('title', 'Tambah Milestone')
@section('page-title', 'Tambah Milestone')
@section('breadcrumb', 'Settings / About / Section 3 / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.about-milestones.index') }}" class="cms-btn">Kembali</a>
    <button form="milestone-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="milestone-form" method="POST" action="{{ route('admin.about-milestones.store') }}">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Tahun <span class="cms-required">*</span></label>
                <input type="text" name="year" value="{{ old('year') }}" class="cms-input @error('year') is-error @enderror" placeholder="2018">
                @error('year')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="cms-input" min="0">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Headline <span class="cms-required">*</span></label>
            <input type="text" name="headline" value="{{ old('headline') }}" class="cms-input @error('headline') is-error @enderror">
            @error('headline')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi Headline</label>
            <textarea name="headline_description" rows="3" class="cms-input">{{ old('headline_description') }}</textarea>
            @error('headline_description')<span class="cms-error">{{ $message }}</span>@enderror
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
