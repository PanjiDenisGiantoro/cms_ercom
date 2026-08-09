<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class Controller
{
    /**
     * Resolve a single file upload field that may arrive either as a raw
     * uploaded file (no-JS fallback) or as a FilePond temp-upload path.
     */
    protected function resolveUpload(Request $request, string $field, string $directory): ?string
    {
        if ($request->hasFile($field)) {
            return $request->file($field)->store($directory, 'public');
        }

        return $this->promoteTempUpload($request->input($field), $directory);
    }

    /**
     * Resolve an upload for an update() call and merge it into $data by
     * reference: sets the key to the newly stored path if a new file was
     * provided, or removes the key entirely otherwise — so a stale raw
     * value (unresolved temp path, unchanged FilePond preview URL, etc.)
     * never gets persisted to the model.
     */
    protected function applyUpload(array &$data, Request $request, string $field, string $directory): void
    {
        $path = $this->resolveUpload($request, $field, $directory);

        if ($path) {
            $data[$field] = $path;
        } else {
            unset($data[$field]);
        }
    }

    /**
     * Same as resolveUpload() but for multi-file fields (e.g. name="images[]").
     */
    protected function resolveMultipleUploads(Request $request, string $field, string $directory): ?array
    {
        if ($request->hasFile($field)) {
            return collect($request->file($field))
                ->map(fn ($file) => $file->store($directory, 'public'))
                ->all();
        }

        $values = $request->input($field);

        if (! is_array($values)) {
            return null;
        }

        return collect($values)
            ->map(fn ($value) => $this->promoteTempUpload($value, $directory))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Multi-file counterpart to applyUpload().
     */
    protected function applyMultipleUploads(array &$data, Request $request, string $field, string $directory): void
    {
        $paths = $this->resolveMultipleUploads($request, $field, $directory);

        if ($paths) {
            $data[$field] = $paths;
        } else {
            unset($data[$field]);
        }
    }

    /**
     * Resolve a thumbnail image URL from a YouTube video link, for use as a
     * fallback when no thumbnail was uploaded manually. Returns null for
     * non-YouTube links (e.g. Vimeo, direct video URLs, uploaded files).
     */
    protected function resolveVideoThumbnail(?string $videoUrl): ?string
    {
        if (! $videoUrl) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
            return "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
        }

        return null;
    }

    /**
     * Move a FilePond temp upload into its permanent directory. The value is
     * reduced to its basename before touching disk, so this only ever reads
     * files that live directly inside tmp-uploads/ regardless of what the
     * client submits — that's what makes this safe against path traversal.
     */
    private function promoteTempUpload(?string $value, string $directory): ?string
    {
        if (! $value) {
            return null;
        }

        $safePath = 'tmp-uploads/'.basename($value);

        if (! Storage::disk('public')->exists($safePath)) {
            return null;
        }

        $newPath = $directory.'/'.basename($safePath);
        Storage::disk('public')->move($safePath, $newPath);

        return $newPath;
    }
}
