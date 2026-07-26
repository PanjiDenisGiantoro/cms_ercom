@extends('layouts.admin')
@section('title', 'Team - Config')
@section('page-title', 'Team - Config')
@section('breadcrumb', 'Social Proof / Team / Config')

@section('topbar-actions')
    <a href="{{ route('admin.team.index') }}" class="cms-btn">Kembali</a>
    <button form="team-setting-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="team-setting-form" method="POST" action="{{ route('admin.team-settings.update') }}">
    @csrf @method('PUT')
    <div class="cms-card">
        <div class="cms-card-title">Konten Team</div>
        <div class="cms-field">
            <label class="cms-label">Title</label>
            <input type="text" name="headline" value="{{ old('headline', $setting->headline) }}" class="cms-input @error('headline') is-error @enderror">
            @error('headline')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Deskripsi</label>
            <textarea name="subtext" rows="4" class="cms-input">{{ old('subtext', $setting->subtext) }}</textarea>
            @error('subtext')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
    </div>
</form>
@endsection
