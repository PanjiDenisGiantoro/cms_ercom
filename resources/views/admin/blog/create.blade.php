@extends('layouts.admin')
@section('title', 'Tambah Blog')
@section('page-title', 'Tambah Blog')
@section('breadcrumb', 'Content / Blog / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.blog.index') }}" class="cms-btn">Kembali</a>
    <button form="blog-form" type="submit" class="cms-btn cms-btn-primary">Simpan</button>
@endsection

@section('content')
<form id="blog-form" method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="cms-card">
        <div class="cms-field">
            <label class="cms-label">Judul <span class="cms-required">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="cms-input @error('title') is-error @enderror">
            @error('title')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Kategori</label>
                <select name="blog_category_id" class="cms-input @error('blog_category_id') is-error @enderror">
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string) old('blog_category_id') === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('blog_category_id')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Penulis</label>
                <input type="text" name="author" value="{{ old('author') }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Excerpt</label>
            <textarea name="excerpt" rows="2" class="cms-input">{{ old('excerpt') }}</textarea>
            @error('excerpt')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-label">Konten</label>
            <textarea name="content" rows="8" class="cms-input ckeditor">{{ old('content') }}</textarea>
            @error('content')<span class="cms-error">{{ $message }}</span>@enderror
        </div>
        <div class="cms-form-row" style="margin-top:14px">
            <div class="cms-field">
                <label class="cms-label">Cover Image</label>
                <input type="file" name="cover_image" class="cms-input" accept="image/*" data-filepond>
                @error('cover_image')<span class="cms-error">{{ $message }}</span>@enderror
            </div>
            <div class="cms-field">
                <label class="cms-label">Tanggal Publish</label>
                <input type="date" name="published_at" value="{{ old('published_at') }}" class="cms-input">
            </div>
        </div>
        <div class="cms-field" style="margin-top:14px">
            <label class="cms-toggle-label">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                <span>Published</span>
            </label>
        </div>
    </div>
</form>
@endsection
