@extends('layouts.admin')
@section('title', 'Tambah User')
@section('page-title', 'Tambah User')
@section('breadcrumb', 'System / Users / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.users.index') }}" class="cms-btn">Kembali</a>
    <button form="form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="form" method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div class="cms-card">
        <div class="cms-form-row">
            <div class="cms-field">
                <label class="cms-label">Nama <span class="cms-required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="cms-input" autocomplete="off">
                @error('name')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Email <span class="cms-required">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="cms-input" autocomplete="off">
                @error('email')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Password <span class="cms-required">*</span></label>
                <input type="password" name="password" class="cms-input" autocomplete="new-password">
                @error('password')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Konfirmasi Password <span class="cms-required">*</span></label>
                <input type="password" name="password_confirmation" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Role <span class="cms-required">*</span></label>
            <select name="role" class="cms-input">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
            @error('role')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
    </div>
</form>
@endsection
